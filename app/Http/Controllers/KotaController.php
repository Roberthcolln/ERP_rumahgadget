<?php

namespace App\Http\Controllers;

use App\Models\provinsi;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Kota/ Kabupaten';
        $kota = DB::table('Kota')
        ->join('provinsi', 'kota.id_provinsi', 'provinsi.id_provinsi')
        ->get();
        return view('kota.index', compact('title', 'kota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kota/ Kabupaten';
        $provinsi= Provinsi::all();
        return view('kota.create', compact('title', 'provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_provinsi' => 'required',
            'nama_kota' => 'required'
        ]);
        Kota::create($request->all());
        return redirect()->route('kota.index')->with('Sukses', 'Berhasil Tambahkan Kota/ Kabupaten');
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kota = Kota::find($id);
        $title = 'Edit Kota/ Kabupaten';
        $provinsi = Provinsi::all();
        return view('kota.edit', compact('kota', 'title', 'provinsi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kota = Kota::findorfail($id);
        $update = [
            'id_provinsi' => $request->id_provinsi,
            'nama_kota' => $request->nama_kota,
        ];
        $kota->update($update);
        return redirect()->route('kota.index')->with('Sukses', 'Berhasil Edit Kota/ Kabupaten');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kota $kota)
    {
        $kota->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Kota/ Kabupaten');
    }
}
