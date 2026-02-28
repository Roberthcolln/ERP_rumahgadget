<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session; // Tambahkan ini
use Illuminate\Support\Str; // Tambahkan ini untuk Str::random
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class CheckoutController extends Controller
{

    public function indexOrder(Request $request)
    {
        $title = "Daftar Transaksi Penjualan";

        // 1. Gunakan with(['details.product']) agar gambar_produk dari relasi produk terbawa
        // 2. Gunakan scope query untuk menjaga controller tetap bersih
        $query = Order::with([
            'details.product.kategori',
            'details.product.jenis',
            'details.product.tipe',
            'details.product.varian',
            'details.product.warna'
        ])->latest();

        // Filter Pencarian (Nama atau No. Invoice)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pelanggan', 'like', "%{$search}%")
                    ->orWhere('number', 'like', "%{$search}%");
            });
        }

        // Filter Tanggal - Menggunakan whereDate agar lebih akurat dan bersih
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [
                $request->from . ' 00:00:00',
                $request->to . ' 23:59:59'
            ]);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('order.index', compact('orders', 'title'));
    }

    public function prosesCheckout(Request $request)
    {
        $cart = Session::get('cart');
        if (!$cart) return response()->json(['error' => 'Keranjang kosong'], 400);

        try {
            return DB::transaction(function () use ($request, $cart) {
                $total = 0;
                foreach ($cart as $item) {
                    $total += $item['harga'] * $item['quantity'];
                }

                $invoiceNumber = 'INV-' . strtoupper(Str::random(6)) . time();

                // Simpan Order
                $order = Order::create([
                    'number' => $invoiceNumber,
                    'nama_pelanggan' => $request->nama,
                    'whatsapp' => $request->wa,
                    'alamat' => $request->alamat ?? '-',
                    'total_harga' => $total,
                    'hp_lama' => $request->hp_lama,
                    'status_pembayaran' => 'pending',
                    'metode_kirim' => $request->metode_kirim,
                ]);

                foreach ($cart as $id => $details) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'produk_id' => $id,
                        'nama_produk' => $details['nama'],
                        'harga' => $details['harga'],
                        'qty' => $details['quantity'],
                    ]);
                }

                // Konfigurasi Midtrans
                Config::$serverKey = config('services.midtrans.serverKey');
                Config::$isProduction = config('services.midtrans.isProduction');
                Config::$isSanitized = true;
                Config::$is3ds = true;

                $params = [
                    'transaction_details' => [
                        'order_id' => $order->number,
                        'gross_amount' => (int)$total,
                    ],
                    'customer_details' => [
                        'first_name' => $request->nama,
                        'phone' => $request->wa,
                    ],
                ];

                $snapToken = Snap::getSnapToken($params);
                $order->update(['snap_token' => $snapToken]);

                // --- KEAMANAN TAMBAHAN ---
                // Simpan token akses unik ke session agar user tidak bisa asal tembak URL /finish
                // Token ini hanya berlaku untuk sesi browser ini saja.
                $accessKey = Str::random(32);
                Session::put('checkout_access_token_' . $order->number, $accessKey);

                Session::forget('cart');

                return response()->json([
                    'snap_token' => $snapToken,
                    'order_id'   => $order->number // Kita kirim ini untuk handling di frontend jika perlu
                ]);
            });
        } catch (\Exception $e) {
            Log::error('Checkout Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memproses pesanan.'], 500);
        }
    }

    public function finish(Request $request)
    {
        $order_id = $request->get('order_id');

        // 1. Validasi keberadaan Order ID di URL
        if (!$order_id) {
            return redirect('/')->with('error', 'Akses ilegal. Order ID tidak ditemukan.');
        }

        // 2. Validasi Session Key (Mencegah user lain menebak URL)
        if (!Session::has('checkout_access_token_' . $order_id)) {
            return redirect('/')->with('error', 'Sesi pembayaran Anda telah berakhir atau tidak sah.');
        }

        // 3. Ambil data Order
        $order = Order::where('number', $order_id)->first();
        if (!$order) {
            return redirect('/')->with('error', 'Pesanan tidak ditemukan di sistem kami.');
        }

        // 4. Validasi Status ke Server Midtrans (Single Source of Truth)
        try {
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');

            $statusMidtrans = Transaction::status($order_id);
            $transaction = $statusMidtrans->transaction_status;
            $fraud = $statusMidtrans->fraud_status;

            // Logika Update berdasarkan Response Midtrans
            if ($transaction == 'capture') {
                if ($fraud == 'challenge') {
                    $order->update(['status_pembayaran' => 'pending']);
                } else if ($fraud == 'accept') {
                    $order->update(['status_pembayaran' => 'success']);
                }
            } else if ($transaction == 'settlement') {
                $order->update(['status_pembayaran' => 'success']);
            } else if ($transaction == 'pending') {
                $order->update(['status_pembayaran' => 'pending']);
            } else if (in_array($transaction, ['deny', 'expire', 'cancel'])) {
                $order->update(['status_pembayaran' => 'failed']);
                return redirect('/')->with('error', 'Pembayaran gagal, dibatalkan, atau kadaluarsa.');
            }
        } catch (\Exception $e) {
            Log::error('Midtrans Status Check Error: ' . $e->getMessage());
            // Jika koneksi gagal, kita gunakan data di database lokal sebagai cadangan
            if ($order->status_pembayaran == 'failed') {
                return redirect('/')->with('error', 'Transaksi gagal.');
            }
        }

        // 5. Jika sampai sini berarti aman (status success atau pending)
        // Hapus session key agar halaman tidak bisa di-refresh terus-menerus (opsional)
        // Session::forget('checkout_access_token_' . $order_id);

        $konf = DB::table('setting')->first();
        return view('checkout_finish', compact('order', 'konf'));
    }

    // Fungsi Update Qty
    public function updateQty(Request $request)
    {
        $cart = session()->get('cart');
        $id = $request->id;

        if (isset($cart[$id])) {
            if ($request->action == 'plus') {
                $cart[$id]['quantity']++;
            } else {
                if ($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity']--;
                }
            }
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }
    }

    // Fungsi Hapus Produk
    public function remove(Request $request)
    {
        $cart = session()->get('cart');
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }
    }
}
