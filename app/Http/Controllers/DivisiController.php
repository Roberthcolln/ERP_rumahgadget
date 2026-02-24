<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Divisi';
        $divisi = Divisi::all();
        return view('divisi.index', compact('title', 'divisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Divisi';
        return view('divisi.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_divisi' => 'required',
        ]);
        Divisi::create($request->all());
        return redirect()->route('divisi.index')->with('Sukses', 'Berhasil Tambah ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $Divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $divisi = Divisi::find($id);
        $title = 'Edit Divisi';
        return view('divisi.edit', compact('title', 'divisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $divisi = Divisi::findorfail($id);
        $update = [
            'nama_divisi' => $request->nama_divisi,
        ];
        $divisi->update($update);
        return redirect()->route('divisi.index')->with('Sukses', 'Berhasil Edit Divisi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $divisi = Divisi::find($id);
        $divisi->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Divisi');
    }
}
