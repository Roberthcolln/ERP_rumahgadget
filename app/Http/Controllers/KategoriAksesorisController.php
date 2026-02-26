<?php

namespace App\Http\Controllers;

use App\Models\KategoriAksesoris;
use Illuminate\Http\Request;

class KategoriAksesorisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Kategori Aksesoris';
        $kategori_aksesoris = KategoriAksesoris::all();
        return view('kategori_aksesoris.index', compact('title', 'kategori_aksesoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kategori Aksesoris';
        return view('kategori_aksesoris.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_aksesoris' => 'required',
        ]);
        KategoriAksesoris::create($request->all());
        return redirect()->route('kategori_aksesoris.index')->with('Sukses', 'Berhasil Tambah kategori Aksesoris');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriAksesoris $kategori_aksesoris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriAksesoris $kategori_aksesoris)
    {
        $title = 'Edit kategori Aksesoris';
        return view('kategori_aksesoris.edit', compact('title', 'kategori_aksesoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriAksesoris $kategori_aksesoris)
    {
        $update = [
            'nama_kategori_aksesoris' => $request->nama_kategori,
        ];
        $kategori_aksesoris->update($update);
        return redirect()->route('kategori_aksesoris.index')->with('Sukses', 'Berhasil Edit kategori Aksesoris');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriAksesoris $kategori_aksesoris)
    {
        $kategori_aksesoris->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data kategori Aksesoris');
    }
}
