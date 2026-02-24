<?php

namespace App\Http\Controllers;

use App\Models\Tipe;
use Illuminate\Http\Request;
use App\Models\Jenis;
use Illuminate\Support\Facades\DB;

class TipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipe = DB::table('tipe')
            ->join('jenis', 'tipe.id_jenis', 'jenis.id_jenis')
            ->join('kategori', 'jenis.id_kategori', 'kategori.id_kategori')
            ->get();
        $title = 'Data Tipe';
        return view('tipe.index', compact('tipe', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis = Jenis::all();
        $title = 'Tambah Jenis';
        return view('tipe.create', compact('jenis', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jenis' => 'required',
            'nama_tipe' => 'required'
        ]);
        Tipe::create($request->all());
        return redirect()->route('tipe.index')->with('Sukses', 'Berhasil Tambah Tipe');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tipe $tipe)
    {
        $jenis = Jenis::all();
        $title = 'Edit Tipe';
        return view('tipe.edit', compact('jenis', 'tipe', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tipe $tipe)
    {
        $update = [
            'id_jenis' => $request->id_jenis,
            'nama_tipe' => $request->nama_tipe,
        ];
        $tipe->update($update);
        return redirect()->route('tipe.index')->with('Sukses', 'Berhasil Update Tipe');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tipe $tipe)
    {
        $tipe->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Tipe');
    }

    public function fetchJenis(Request $request)
    {
        $data['jenis'] = Jenis::where("id_kategori", $request->id_kategori)->get(["nama_jenis", "id_jenis"]);
        return response()->json($data);
    }
    public function fetchTipe(Request $request)
    {
        $data['tipe'] = Tipe::where("id_jenis", $request->id_jenis)->get(["nama_tipe", "id_tipe"]);
        return response()->json($data);
    }
}
