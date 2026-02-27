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

class CheckoutController extends Controller
{

    public function indexOrder(Request $request)
    {
        $title = "Daftar Transaksi Penjualan";

        // 1. Gunakan with(['details.product']) agar gambar_produk dari relasi produk terbawa
        // 2. Gunakan scope query untuk menjaga controller tetap bersih
        $query = Order::with(['details.product'])->latest();

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

                // Simpan Order
                $order = Order::create([
                    'number' => 'INV-' . strtoupper(Str::random(6)) . time(),
                    'nama_pelanggan' => $request->nama,
                    'whatsapp' => $request->wa,
                    'alamat' => $request->alamat ?? '-',
                    'total_harga' => $total,
                    'hp_lama' => $request->hp_lama,
                    'status_pembayaran' => 'pending',
                ]);

                // Simpan Detail
                foreach ($cart as $id => $details) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'produk_id' => $id,
                        'nama_produk' => $details['nama'],
                        'harga' => $details['harga'],
                        'qty' => $details['quantity'],
                    ]);
                }

                // Midtrans
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

                Session::forget('cart');

                return response()->json(['snap_token' => $snapToken]);
            });
        } catch (\Exception $e) {
            // Log error ke storage/logs/laravel.log agar bisa dibaca
            Log::error('Checkout Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function finish(Request $request)
    {
        $order_id = $request->get('order_id');

        // Cari data order berdasarkan nomor invoice
        $order = Order::where('number', $order_id)->first();

        if (!$order) {
            return redirect('/')->with('error', 'Pesanan tidak ditemukan.');
        }

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
