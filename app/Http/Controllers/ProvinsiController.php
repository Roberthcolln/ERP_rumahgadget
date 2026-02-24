<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Provinsi';
        $provinsi = Provinsi::all();
        return view('provinsi.index', compact('title', 'provinsi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Provinsi';
        return view('provinsi.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_provinsi' => 'required',
        ]);
        Provinsi::create($request->all());
        return redirect()->route('provinsi.index')->with('Sukses', 'Berhasil Tambah Provinsi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provinsi $provinsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provinsi $provinsi)
    {
        $title = 'Edit Provinsi';
        return view('provinsi.edit', compact('title', 'provinsi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provinsi $provinsi)
    {
        $update = [
            'nama_provinsi' => $request->nama_provinsi,
        ];
        $provinsi->update($update);
        return redirect()->route('provinsi.index')->with('Sukses', 'Berhasil Edit Provinsi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinsi $provinsi)
    {
        $provinsi->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data Provinsi');
    }
}
