<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Gudang;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $title = "Data Stok";

        $user = auth()->user();
        $idGudang = $user->gudangAkses();

        $query = Stok::with(['produk.kategori', 'gudang'])
            ->when(
                $request->nama_produk,
                fn($q) =>
                $q->whereHas(
                    'produk',
                    fn($sub) =>
                    $sub->where('nama_produk', 'like', '%' . $request->nama_produk . '%')
                )
            )
            ->when(
                $request->id_kategori,
                fn($q) =>
                $q->whereHas(
                    'produk',
                    fn($sub) =>
                    $sub->where('id_kategori', $request->id_kategori)
                )
            )
            ->when(
                $request->qty_min,
                fn($q) =>
                $q->where('qty', '>=', $request->qty_min)
            )
            ->when(
                $request->qty_max,
                fn($q) =>
                $q->where('qty', '<=', $request->qty_max)
            );

        // FILTER GUDANG UNTUK KASIR
        if ($user->id != 1) {
            // kasir hanya lihat gudang sendiri
            $query->where('id_gudang', $idGudang);
        } else {
            // admin boleh filter gudang
            if ($request->id_gudang) {
                $query->where('id_gudang', $request->id_gudang);
            }
        }

        $stok = $query->orderBy('qty', 'desc')->get();

        // LIST GUDANG UNTUK FILTER
        if ($user->id == 1) {
            $gudang = Gudang::all(); // admin lihat semua
        } else {
            $gudang = Gudang::where('id_gudang', $idGudang)->get(); // kasir hanya gudang sendiri
        }

        $kategori = Kategori::all();

        return view('stok.index', compact('title', 'stok', 'gudang', 'kategori', 'request'));
    }

    public function show($id)
    {
        $title = "Detail Stok Produk";
        // Mengambil data stok berdasarkan ID beserta relasi produk dan gudangnya
        $stok = \App\Models\Stok::with(['produk', 'gudang'])->findOrFail($id);

        return view('stok.show', compact('title', 'stok'));
    }
}
