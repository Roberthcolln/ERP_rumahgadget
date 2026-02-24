<?php

namespace App\Http\Controllers;

use App\Models\KategoriAnggota;
use Illuminate\Http\Request;

class KategoriAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Kategori Anggota';
        $kategori_anggota = KategoriAnggota::all();
        return view('kategori_anggota.index', compact('title', 'kategori_anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kategori Anggota';
        return view('kategori_anggota.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_anggota' => 'required'
        ]);
        KategoriAnggota::create($request->all());
        return redirect()->route('kategori_anggota.index')->with('Sukses', 'Berhasil Tambah Kategori Anggota');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriAnggota $kategoriAnggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Edit Kategori Anggota';
        $kategori_anggota = KategoriAnggota::find($id);
        return view('kategori_anggota.edit', compact('title', 'kategori_anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kategori_anggota = KategoriAnggota::findorfail($id);
        $update = [
            'nama_kategori_anggota' => $request->nama_kategori_anggota,
        ];
        $kategori_anggota->update($update);
        return redirect()->route('kategori_anggota.index')->with('Sukses', 'Berhasil Edit Kategori Anggota');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori_anggota = KategoriAnggota::find($id);
        $kategori_anggota->delete();
        return redirect()->back()->with('Sukses',' Berhasil Hapus Kategori Anggota');
    }
}
