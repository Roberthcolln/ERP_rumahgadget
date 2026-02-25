<?php

namespace App\Http\Controllers;

use App\Models\Warna;
use Illuminate\Http\Request;

class WarnaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Warna';
        $warna = Warna::all();
        return view('warna.index', compact('title', 'warna'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Warna';
        return view('warna.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_warna' => 'required',
        ]);
        Warna::create($request->all());
        return redirect()->route('warna.index')->with('Sukses', 'Berhasil Tambah Warna');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warna $warna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warna $warna)
    {
        $title = 'Edit Warna';
        return view('warna.edit', compact('title', 'warna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warna $warna)
    {
        $update = [
            'nama_warna' => $request->nama_warna,
        ];
        $warna->update($update);
        return redirect()->route('warna.index')->with('Sukses', 'Berhasil Edit Warna');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warna $warna)
    {
        $warna->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data Warna');
    }
}
