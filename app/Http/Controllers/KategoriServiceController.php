<?php

namespace App\Http\Controllers;

use App\Models\KategoriService;
use Illuminate\Http\Request;

class KategoriServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Kategori Service';
        $kategori_service = KategoriService::all();
        return view('kategori_service.index', compact('title', 'kategori_service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kategori Service';
        return view('kategori_service.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_service' => 'required',
        ]);
        KategoriService::create($request->all());
        return redirect()->route('kategori_service.index')->with('Sukses', 'Berhasil Tambah kategori Service');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriService $kategori_service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriService $kategori_service)
    {
        $title = 'Edit kategori Service';
        return view('kategori_service.edit', compact('title', 'kategori_service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriService $kategori_service)
    {
        $update = [
            'nama_kategori_service' => $request->nama_kategori,
        ];
        $kategori_service->update($update);
        return redirect()->route('kategori_service.index')->with('Sukses', 'Berhasil Edit kategori Service');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriService $kategori_service)
    {
        $kategori_service->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data kategori Service');
    }
}
