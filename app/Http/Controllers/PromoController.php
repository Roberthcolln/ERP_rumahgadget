<?php

namespace App\Http\Controllers;

use App\Models\Promo; // Pastikan Model sudah dibuat
use Illuminate\Http\Request;

class PromoController extends Controller
{
    // Menampilkan daftar promo
    public function index()
    {
        $promos = Promo::latest()->get();
        return view('promo.index', compact('promos'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('promo.create');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_promo' => 'required|string|max:255',
            'kode_promo' => 'required|string|unique:promo_gadget,kode_promo|max:20',
            'tipe_promo' => 'required|in:persentase,nominal',
            'nilai_promo' => 'required|numeric|min:0',
            'minimal_pembelian' => 'nullable|numeric|min:0',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'kuota_total' => 'required|integer|min:1',
        ]);

        Promo::create($request->all());

        return redirect()->route('promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit(Promo $promo)
    {
        return view('promo.edit', compact('promo'));
    }

    // Memperbarui data
    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'nama_promo' => 'required|string|max:255',
            'kode_promo' => 'required|string|max:20|unique:promo_gadget,kode_promo,' . $promo->id,
            'tipe_promo' => 'required|in:persentase,nominal',
            'nilai_promo' => 'required|numeric|min:0',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'status' => 'required|boolean',
        ]);

        $promo->update($request->all());

        return redirect()->route('promo.index')->with('success', 'Promo berhasil diperbarui!');
    }

    // Menghapus promo
    public function destroy(Promo $promo)
    {
        $promo->delete();
        return redirect()->route('promo.index')->with('success', 'Promo berhasil dihapus!');
    }
}
