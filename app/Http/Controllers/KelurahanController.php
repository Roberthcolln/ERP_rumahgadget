<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Provinsi;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelurahan = DB::table('kelurahan')
            ->join('kecamatan', 'kelurahan.id_kecamatan', 'kecamatan.id_kecamatan')
            ->join('kota', 'kecamatan.id_kota', 'kota.id_kota')
            ->join('provinsi', 'kota.id_provinsi', 'provinsi.id_provinsi')
            ->get();
        $title = 'Desa';
        return view('kelurahan.index', compact('title', 'kelurahan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Desa';
        $provinsi = DB::table('provinsi')->get();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        return view('kelurahan.create', compact('title', 'provinsi', 'kota', 'kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelurahan' => 'required',
            'id_kecamatan' => 'required'
        ]);
        Kelurahan::create($request->all());
        return redirect()->route('kelurahan.index')->with('Sukses', 'Berhasil Tambah Desa');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelurahan $kelurahan)
    {
        $provinsi = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $title = 'Edit Desa';
        return view('kelurahan.edit', compact('provinsi', 'kota', 'kecamatan', 'title', 'kelurahan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelurahan $kelurahan)
    {
        $update = [
            'id_kecamatan' => $request->id_kecamatan,
            'nama_kelurahan' => $request->nama_kelurahan,
        ];
        $kelurahan->update($update);
        return redirect()->route('kelurahan.index')->with('Sukses', 'Berhasil Edit Desa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelurahan $kelurahan)
    {
        $kelurahan->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Desa');
    }
    public function fetchCamat(Request $request)
    {
        $data['kecamatan'] = Kecamatan::where("id_kota", $request->id_kota)->get(["nama_kecamatan", "id_kecamatan"]);
        return response()->json($data);
    }

    /**
     * Fetch Kelurahan berdasarkan Kecamatan yang dipilih.
     */
    public function fetchLurah(Request $request)
    {
        $data['kelurahan'] = Kelurahan::where("id_kecamatan", $request->id_kecamatan)->get(["nama_kelurahan", "id_kelurahan"]);
        return response()->json($data);
    }

    // Fungsi AJAX untuk ambil Kota
    public function fetchKota(Request $request)
    {
        $data['kota'] = Kota::where("id_provinsi", $request->id_pusat)->get(["nama_kota", "id_kota"]);
        return response()->json($data);
    }

    // Fungsi AJAX untuk ambil Kecamatan
    public function fetchKecamatan(Request $request)
    {
        $data['kecamatan'] = Kecamatan::where("id_kota", $request->id_kota)->get(["nama_kecamatan", "id_kecamatan"]);
        return response()->json($data);
    }
}
