<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\Kategori;
use App\Models\Jenis;
use App\Models\Tipe;
use App\Models\Varian;
use App\Models\Warna;
use Illuminate\Http\Request;

class KreditController extends Controller
{
    public function index()
    {
        $title = 'Data Kredit Produk';
        $kredit = Kredit::with(['kategori', 'jenis', 'tipe', 'varian', 'warna'])->get();
        return view('kredit.index', compact('title', 'kredit'));
    }

    public function create()
    {
        $title = 'Tambah Skema Kredit';
        $kategori = Kategori::all();
        $jenis = Jenis::all();
        $tipe = Tipe::all();
        $varian = Varian::all();
        $warna = Warna::all();
        $opsi_cicilan = [6, 9, 12]; // Sesuai permintaan Anda

        return view('kredit.create', compact('title', 'kategori', 'jenis', 'tipe', 'varian', 'warna', 'opsi_cicilan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'id_jenis'    => 'required',
            'id_tipe'     => 'required',
            'id_varian'   => 'required',
            'id_warna'    => 'required',
            'harga_kredit' => 'required|numeric',
            'dp'          => 'required|numeric',
            'cicilan'     => 'required|in:6,9,12',
            'harga_cicilan' => 'required|numeric|min:0',
        ]);

        Kredit::create($request->all());
        return redirect()->route('kredit.index')->with('Sukses', 'Skema Kredit berhasil ditambahkan');
    }

    public function edit($id)
    {
        $title = 'Edit Skema Kredit';
        $kredit = Kredit::findOrFail($id);
        $kategori = Kategori::all();
        $jenis = Jenis::all();
        $tipe = Tipe::all();
        $varian = Varian::all();
        $warna = Warna::all();
        $opsi_cicilan = [6, 9, 12];

        return view('kredit.edit', compact('title', 'kredit', 'kategori', 'jenis', 'tipe', 'varian', 'warna', 'opsi_cicilan'));
    }

    public function update(Request $request, $id)
    {
        $kredit = Kredit::findOrFail($id);
        $kredit->update($request->all());
        return redirect()->route('kredit.index')->with('Sukses', 'Skema Kredit berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kredit::destroy($id);
        return redirect()->back()->with('Sukses', 'Skema Kredit berhasil dihapus');
    }
}
