<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Stok;
use App\Models\Setting;
use App\Models\Pelanggan; // Pastikan ini diimport
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function index(Request $request)
    {
        $konf = Setting::first();
        $title = 'Point Of Sale';
        $user = auth()->user();
        $idGudangUser = $user->gudangAkses();
        $idGudang = $request->id_gudang ?? $idGudangUser;

        $query = Produk::with(['gudang', 'kategori']);

        if ($idGudang) {
            $query->whereHas('gudang', function ($q) use ($idGudang) {
                $q->where('gudang.id_gudang', $idGudang);
            });
        }

        $produk = $query->get()->groupBy('kategori.nama_kategori');

        if ($user->jabatan == 'Admin') {
            $gudang = \App\Models\Gudang::all();
        } else {
            $gudang = \App\Models\Gudang::where('id_gudang', $idGudangUser)->get();
        }

        return view('pos.index', compact('produk', 'title', 'konf', 'gudang', 'idGudang'));
    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();
        try {
            $total = $request->total;
            $bayar = $request->bayar;
            $kembali = $bayar - $total;

            if ($bayar < $total) {
                return response()->json(['success' => false, 'message' => 'Uang tidak cukup']);
            }

            // 1. LOGIKA PELACAKAN PELANGGAN & POIN
            $pelanggan = Pelanggan::where(function ($query) use ($request) {
                if ($request->no_hp) {
                    $query->where('no_hp', $request->no_hp);
                } elseif ($request->email) {
                    $query->where('email', $request->email);
                } else {
                    $query->where('nama_pelanggan', $request->nama_pelanggan);
                }
            })->first();

            if ($pelanggan) {
                // Update data jika sudah ada
                $pelanggan->update([
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'email'          => $request->email,
                ]);
            } else {
                // Buat baru jika belum ada (Password default agar tidak General Error 1364)
                $pelanggan = Pelanggan::create([
                    'nama_pelanggan' => $request->nama_pelanggan,
                    'no_hp'          => $request->no_hp,
                    'email'          => $request->email,
                    'password'       => bcrypt('12345678'),
                    'point'          => 0,
                    'level'          => 'Bronze',
                    'status'         => 'Active'
                ]);
            }

            // Update Poin Pelanggan (Memanggil method addPoints di model)
            $pelanggan->addPoints($total);

            $user = auth()->user();

            // 2. Simpan Transaksi Penjualan
            $penjualan = Penjualan::create([
                'kode_invoice'      => 'INV' . time(),
                'id_user'           => $user->id,
                'id_pelanggan'      => $pelanggan->id_pelanggan,
                'tanggal_penjualan' => $request->tanggal_penjualan ?? now(),
                'total'             => $total,
                'bayar'             => $bayar,
                'kembali'           => $kembali,
                'status'            => 'selesai'
            ]);

            // 3. Simpan Detail Item & Update Stok
            foreach ($request->items as $item) {
                PenjualanDetail::create([
                    'id_penjualan' => $penjualan->id_penjualan,
                    'id_produk'    => $item['id_produk'],
                    'qty'          => $item['qty'],
                    'harga'        => $item['harga'],
                    'subtotal'     => $item['qty'] * $item['harga']
                ]);

                $idGudang = $user->gudangAkses();
                $stok = Stok::where('id_produk', $item['id_produk'])
                    ->when($idGudang, fn($q) => $q->where('id_gudang', $idGudang))
                    ->first();

                if (!$stok || $stok->qty < $item['qty']) {
                    throw new \Exception('Stok produk ' . ($item['nama_produk'] ?? '') . ' tidak cukup.');
                }
                $stok->decrement('qty', $item['qty']);
            }

            DB::commit();
            return response()->json([
                'success'      => true,
                'id'           => $penjualan->id_penjualan,
                'kode_invoice' => $penjualan->kode_invoice
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function batal($id)
    {
        DB::transaction(function () use ($id) {
            $penjualan = Penjualan::with('detail.produk.gudang')->findOrFail($id);
            foreach ($penjualan->detail as $d) {
                $stok = Stok::where('id_produk', $d->id_produk)->first();
                if ($stok) {
                    $stok->increment('qty', $d->qty);
                }
            }
            $penjualan->update(['status' => 'batal']);
        });

        return back()->with('success', 'Transaksi dibatalkan');
    }

    public function print($id)
    {
        $konf = Setting::first();
        $penjualan = Penjualan::with('detail.produk')->findOrFail($id);
        return view('pos.print', compact('penjualan', 'konf'));
    }
}
