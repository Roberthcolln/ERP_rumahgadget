<?php

namespace App\Http\Controllers;

use App\Models\RateCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RateCardController extends Controller
{
    public function index()
    {
        $title = 'Rate Card Layanan';
        $ratecards = RateCard::orderBy('platform', 'asc')->get();
        return view('ratecard.index', compact('title', 'ratecards'));
    }

    public function create()
    {
        if (auth()->user()->jabatan != 'Admin' && auth()->user()->id != 1) {
            return redirect()->route('ratecard.index')->with('error', 'Akses ditolak.');
        }
        $title = 'Tambah Layanan';
        return view('ratecard.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'platform' => 'required|array|min:1', // Validasi array
            'harga' => 'required|numeric',
            'gambar_layanan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambar = $request->file('gambar_layanan');
        $namaGambar = 'RateCard_' . time() . '.' . $gambar->getClientOriginalExtension();
        $gambar->move('file/ratecard/', $namaGambar);

        RateCard::create([
            'nama_layanan' => $request->nama_layanan,
            'platform' => $request->platform, // Langsung simpan array (otomatis jadi JSON karena casting)
            'deskripsi_layanan' => $request->deskripsi_layanan,
            'harga' => $request->harga,
            'gambar_layanan' => $namaGambar,
            'slug_layanan' => Str::slug($request->nama_layanan),
        ]);

        return redirect()->route('ratecard.index')->with('Sukses', 'Layanan berhasil ditambahkan');
    }

    public function edit($id)
    {
        if (auth()->user()->jabatan != 'Admin' && auth()->user()->id != 1) {
            return redirect()->route('ratecard.index')->with('error', 'Akses ditolak.');
        }
        $ratecard = RateCard::findOrFail($id);
        $title = 'Edit Layanan';
        return view('ratecard.edit', compact('ratecard', 'title'));
    }

    public function update(Request $request, $id)
    {
        $ratecard = RateCard::findOrFail($id);
        $namaGambar = $ratecard->gambar_layanan;

        if ($request->hasFile('gambar_layanan')) {
            // Hapus gambar lama
            if (file_exists(public_path('file/ratecard/' . $namaGambar))) {
                @unlink(public_path('file/ratecard/' . $namaGambar));
            }
            $gambar = $request->file('gambar_layanan');
            $namaGambar = 'RateCard_' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('file/ratecard/', $namaGambar);
        }

        $ratecard->update([
            'nama_layanan' => $request->nama_layanan,
            'platform' => $request->platform,
            'deskripsi_layanan' => $request->deskripsi_layanan,
            'harga' => $request->harga,
            'gambar_layanan' => $namaGambar,
            'slug_layanan' => Str::slug($request->nama_layanan),
        ]);

        return redirect()->route('ratecard.index')->with('Sukses', 'Layanan berhasil diupdate');
    }

    public function destroy($id)
    {
        $ratecard = RateCard::findOrFail($id);
        if (file_exists(public_path('file/ratecard/' . $ratecard->gambar_layanan))) {
            @unlink(public_path('file/ratecard/' . $ratecard->gambar_layanan));
        }
        $ratecard->delete();
        return redirect()->back()->with('Sukses', 'Layanan berhasil dihapus');
    }
}
