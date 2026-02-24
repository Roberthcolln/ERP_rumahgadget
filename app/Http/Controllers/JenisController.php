<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Jenis';
        $jenis = DB::table('jenis')
            ->join('kategori', 'jenis.id_kategori', 'kategori.id_kategori')
            ->get();
        return view('jenis.index', compact('title', 'jenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Jenis';
        $kategori = Kategori::all();
        return view('jenis.create', compact('title', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_jenis' => 'required'
        ]);
        Jenis::create($request->all());
        return redirect()->route('jenis.index')->with('Sukses', 'Berhasil Tambahkan Jenis');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jenis = Jenis::find($id);
        $title = 'Edit Jenis';
        $kategori = Kategori::all();
        return view('jenis.edit', compact('title', 'kategori', 'jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jenis = Jenis::findOrFail($id);
        $update = [
            'nama_jenis' => $request->nama_jenis,
            'id_kategori' => $request->id_kategori,
        ];
        $jenis->update($update);
        return redirect()->route('jenis.index')->with('Sukses', 'Berhasil Edit Jenis');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis $jenis)
    {
        $jenis->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Jenis');
    }
}
