<?php

namespace App\Http\Controllers;

use App\Models\SewaProduk;
use App\Models\Produk;
use Illuminate\Http\Request;

class SewaProdukController extends Controller
{
    public function index()
    {
        $title = 'Data Sewa iPhone';
        $sewa = SewaProduk::with('produk.kategori')->get();
        return view('sewa.index', compact('title', 'sewa'));
    }

    public function create()
    {
        $title = 'Tambah Sewa iPhone';
        // Filter produk hanya yang berkategori 'Apple'
        $produk = Produk::whereHas('kategori', function ($q) {
            $q->where('nama_kategori', 'Apple');
        })->get();

        return view('sewa.create', compact('title', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|unique:sewa_produk,id_produk',
            'harga_24_jam' => 'required|numeric',
            'harga_per_jam' => 'required|numeric',
        ]);

        SewaProduk::create($request->all());
        return redirect()->route('sewa.index')->with('Sukses', 'Data sewa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $title = 'Edit Sewa iPhone';
        $sewa = SewaProduk::findOrFail($id);
        $produk = Produk::whereHas('kategori', function ($q) {
            $q->where('nama_kategori', 'Apple');
        })->get();

        return view('sewa.edit', compact('title', 'sewa', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $sewa = SewaProduk::findOrFail($id);
        $sewa->update($request->all());
        return redirect()->route('sewa.index')->with('Sukses', 'Data sewa berhasil diupdate');
    }

    public function destroy($id)
    {
        $sewa = SewaProduk::findOrFail($id);
        $sewa->delete();
        return redirect()->back()->with('Sukses', 'Data sewa berhasil dihapus');
    }
}
