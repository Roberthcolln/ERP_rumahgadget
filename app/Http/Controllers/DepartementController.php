<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Departement';
        $departement = Departement::all();
        return view('departement.index', compact('departement', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Departement';
        return view('departement.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_karyawan' => 'required'
        ]);
        Departement::create($request->all());
        return redirect()->route('departement.index')->with('Sukses', 'Berhasil Tambahkan Departement');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $Departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $departement = Departement::find($id);
        $title = 'Edit Departement';
        return view('departement.edit', compact('departement', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $departement = Departement::findorfail($id);
        $update = [
            'nama_kategori_karyawan' => $request->nama_kategori_karyawan,
        ];
        $departement->update($update);
        return redirect()->route('departement.index')->with('Sukses', 'Berhasil Edit Departement');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Departement');
    }
}
