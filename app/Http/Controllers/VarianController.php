<?php

namespace App\Http\Controllers;

use App\Models\Varian;
use Illuminate\Http\Request;

class VarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Varian';
        $varian = Varian::all();
        return view('varian.index', compact('title', 'varian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Varian';
        return view('varian.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_varian' => 'required',
        ]);
        Varian::create($request->all());
        return redirect()->route('varian.index')->with('Sukses', 'Berhasil Tambah Varian');
    }

    /**
     * Display the specified resource.
     */
    public function show(Varian $varian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Varian $varian)
    {
        $title = 'Edit Varian';
        return view('varian.edit', compact('title', 'varian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Varian $varian)
    {
        $update = [
            'nama_varian' => $request->nama_varian,
        ];
        $varian->update($update);
        return redirect()->route('varian.index')->with('Sukses', 'Berhasil Edit Varian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Varian $varian)
    {
        $varian->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data Varian');
    }
}
