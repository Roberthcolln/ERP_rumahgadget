<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Gudang;
use App\Models\Stok;
use App\Models\TransaksiStok;
use App\Models\DetailTransaksiStok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiStokController extends Controller
{
    public function index()
    {
        $history = TransaksiStok::with(['gudang', 'user'])->latest()->get();
        return view('stok.history', compact('history'));
    }

    public function createMasuk()
    {
        $title = "Barang Masuk";
        $gudang = Gudang::all();
        $produk = Produk::all();
        // AMBIL DATA SUPPLIER AKTIF
        $suppliers = Supplier::where('status', 'aktif')->get();

        return view('stok.masuk', compact('title', 'gudang', 'produk', 'suppliers'));
    }

    public function storeMasuk(Request $request)
    {
        $request->validate([
            'id_gudang' => 'required',
            'pihak_eksternal' => 'required',
            'items' => 'required|array',
            'items.*.id_produk' => 'required',
            'items.*.qty' => 'required|numeric|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $transaksi = TransaksiStok::create([
                'no_bukti' => 'BM-' . date('YmdHis'),
                'jenis' => 'masuk',
                'id_gudang' => $request->id_gudang,
                'id_user_petugas' => auth()->id(),
                'pihak_eksternal' => $request->pihak_eksternal,
                'catatan' => $request->catatan
            ]);

            foreach ($request->items as $item) {
                DetailTransaksiStok::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $item['id_produk'],
                    'qty' => $item['qty']
                ]);

                // Update Stok di GUDANG (Menambah barang di gudang fisik)
                $stok = Stok::where('id_produk', $item['id_produk'])
                    ->where('id_gudang', $request->id_gudang)
                    ->first();

                if ($stok) {
                    $stok->increment('qty', $item['qty']);
                } else {
                    Stok::create([
                        'id_produk' => $item['id_produk'],
                        'id_gudang' => $request->id_gudang,
                        'qty' => $item['qty']
                    ]);
                }
            }
        });

        return redirect()->route('stok.index')->with('Sukses', 'Barang masuk berhasil dicatat ke gudang.');
    }

    public function createKeluar()
    {
        $title = "Barang Keluar";
        $gudang = Gudang::all();
        $produk = Produk::all();
        // Customer awal kosongkan dulu, akan diisi lewat JavaScript
        $customers = [];

        return view('stok.keluar', compact('title', 'gudang', 'produk', 'customers'));
    }

    // Method baru untuk API pencarian User berdasarkan Gudang
    // Method API pencarian User berdasarkan Gudang
    public function getUsersSesuaiGudang($id_gudang)
    {
        $gudang = Gudang::find($id_gudang);

        // Filter dasar: Bukan Admin
        $query = \App\Models\User::where('jabatan', '!=', 'Admin');

        if ($gudang) {
            if ($gudang->nama_gudang == 'Gudang GA') {
                // Filter user id_region 1 (Gunung Agung)
                $query->where('id_region', 1);
            } elseif ($gudang->nama_gudang == 'Gudang TU') {
                // Filter user id_region 2 (Teuku Umar)
                $query->where('id_region', 2);
            } else {
                // Opsional: Jika bukan GA atau TU, apakah ingin menampilkan semua user 
                // atau tidak sama sekali? Untuk saat ini kita tampilkan semua non-admin.
            }
        }

        $users = $query->get(['id', 'name', 'jabatan']);
        return response()->json($users);
    }

    public function storeKeluar(Request $request)
    {
        $request->validate([
            'id_gudang' => 'required',
            'pihak_eksternal' => 'required',
            'items' => 'required|array',
            'items.*.id_produk' => 'required',
            'items.*.qty' => 'required|numeric|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $transaksi = TransaksiStok::create([
                    'no_bukti' => 'BK-' . date('YmdHis'),
                    'jenis' => 'keluar',
                    'id_gudang' => $request->id_gudang,
                    'id_user_petugas' => auth()->id(),
                    'pihak_eksternal' => $request->pihak_eksternal,
                    'catatan' => $request->catatan
                ]);

                foreach ($request->items as $item) {
                    // 1. Ambil data stok di GUDANG
                    $stokGudang = Stok::where('id_produk', $item['id_produk'])
                        ->where('id_gudang', $request->id_gudang)
                        ->first();

                    $produk = Produk::find($item['id_produk']);
                    $namaProduk = $produk ? $produk->nama_produk : "ID: " . $item['id_produk'];

                    // 2. Validasi stok gudang cukup
                    if (!$stokGudang || $stokGudang->qty < $item['qty']) {
                        $sisa = $stokGudang ? $stokGudang->qty : 0;
                        throw new \Exception("Stok gudang tidak mencukupi untuk [$namaProduk]. Tersisa: $sisa");
                    }

                    // 3. KURANGI stok di GUDANG
                    $stokGudang->decrement('qty', $item['qty']);

                    // 4. TAMBAHKAN ke stok di PRODUK (Sesuai permintaan Anda)
                    // Logika: Barang yang keluar dari gudang menjadi 'ready' di data Produk utama
                    $produk->increment('qty', $item['qty']);

                    // 5. Simpan Detail
                    DetailTransaksiStok::create([
                        'id_transaksi' => $transaksi->id_transaksi,
                        'id_produk' => $item['id_produk'],
                        'qty' => $item['qty']
                    ]);
                }
            });

            return redirect()->route('stok.index')->with('Sukses', 'Barang berhasil dikeluarkan dari gudang dan masuk ke stok produk.');
        } catch (\Exception $e) {
            return back()->with('Gagal', $e->getMessage())->withInput();
        }
    }
}
