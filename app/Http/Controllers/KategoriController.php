<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Kategori';
        $kategori = Kategori::all();
        return view('kategori.index', compact('title', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kategori';
        return view('kategori.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);
        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('Sukses', 'Berhasil Tambah kategori');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        $title = 'Edit kategori';
        return view('kategori.edit', compact('title', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $update = [
            'nama_kategori' => $request->nama_kategori,
        ];
        $kategori->update($update);
        return redirect()->route('kategori.index')->with('Sukses', 'Berhasil Edit kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data kategori');
    }
}
