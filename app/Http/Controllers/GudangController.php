<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    /**
     * Display a listing of gudang.
     */
    public function index()
    {
        $title = 'Data Gudang';
        $gudang = Gudang::latest()->get();

        return view('gudang.index', compact('title', 'gudang'));
    }

    /**
     * Show form create gudang.
     */
    public function create()
    {
        $title = 'Tambah Gudang';

        return view('gudang.create', compact('title'));
    }

    /**
     * Store new gudang.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'kode_gudang' => 'required|string|max:50|unique:gudang,kode_gudang',
            'alamat_gudang' => 'required|string',
            'penanggung_jawab' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Gudang::create($validated);

        return redirect()
            ->route('gudang.index')
            ->with('Sukses', 'Berhasil menambahkan gudang');
    }

    /**
     * Show form edit gudang.
     */
    public function edit(Gudang $gudang)
    {
        $title = 'Edit Gudang';

        return view('gudang.edit', compact('title', 'gudang'));
    }

    /**
     * Update gudang.
     */
    public function update(Request $request, Gudang $gudang)
    {
        $validated = $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'kode_gudang' => 'required|string|max:50|unique:gudang,kode_gudang,' . $gudang->id_gudang . ',id_gudang',
            'alamat_gudang' => 'required|string',
            'penanggung_jawab' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $gudang->update($validated);

        return redirect()
            ->route('gudang.index')
            ->with('Sukses', 'Berhasil update gudang');
    }

    /**
     * Delete gudang.
     */
    public function destroy(Gudang $gudang)
    {
        $gudang->delete();

        return redirect()
            ->back()
            ->with('Sukses', 'Berhasil hapus gudang');
    }
}
