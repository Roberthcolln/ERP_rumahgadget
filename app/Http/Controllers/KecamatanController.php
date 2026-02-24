<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Models\Kota;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kecamatan = DB::table('kecamatan')
            ->join('kota', 'kecamatan.id_kota', 'kota.id_kota')
            ->join('provinsi', 'kota.id_provinsi', 'provinsi.id_provinsi')
            ->get();
        $title = 'Data Kecamatan';
        return view('kecamatan.index', compact('kecamatan', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kota = kota::all();
        $title = 'Tambah Kecamatan';
        return view('kecamatan.create', compact('kota', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kota' => 'required',
            'nama_kecamatan' => 'required'
        ]);
        Kecamatan::create($request->all());
        return redirect()->route('kecamatan.index')->with('Sukses', 'Berhasil Tambah Kecamatan');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kecamatan $kecamatan)
    {
        $kota = Kota::all();
        $title = 'Edit Kecamatan';
        return view('kecamatan.edit', compact('kota', 'kecamatan', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $update = [
            'id_kota' => $request->id_kota,
            'nama_kecamatan' => $request->nama_kecamatan,
        ];
        $kecamatan->update($update);
        return redirect()->route('kecamatan.index')->with('Sukses', 'Berhasil Update Kecamatan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Kecamatan');
    }
}
