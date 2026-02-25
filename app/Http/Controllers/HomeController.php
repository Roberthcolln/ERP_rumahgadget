<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Musik;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Supplier;
use App\Models\Tipe;
use App\Models\Varian;
use App\Models\Warna;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $konf = DB::table('setting')->first();
        return view('welcome', compact(
            'konf',
        ));
    }

    public function harga(Request $request)
    {
        $konf = DB::table('setting')->first();

        // Ambil semua input
        $search = $request->get('search');
        $id_kategori = $request->get('kategori');
        $id_jenis = $request->get('jenis');
        $id_tipe = $request->get('tipe');

        $produk = Produk::with(['tipe', 'jenis', 'varian', 'warna'])
            // Filter Pencarian Global (Nama, Deskripsi, Tipe, Jenis)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_produk', 'LIKE', "%{$search}%")
                        ->orWhere('deskripsi_produk', 'LIKE', "%{$search}%")
                        ->orWhereHas('tipe', function ($t) use ($search) {
                            $t->where('nama_tipe', 'LIKE', "%{$search}%");
                        })
                        ->orWhereHas('jenis', function ($j) use ($search) {
                            $j->where('nama_jenis', 'LIKE', "%{$search}%");
                        });
                });
            })
            // Filter Dropdown
            ->when($id_kategori, fn($q) => $q->where('id_kategori', $id_kategori))
            ->when($id_jenis, fn($q) => $q->where('id_jenis', $id_jenis))
            ->when($id_tipe, fn($q) => $q->where('id_tipe', $id_tipe))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $kategori = Kategori::all();

        return view('harga', compact('konf', 'produk', 'kategori'));
    }

    public function getJenis(Request $request)
    {
        return response()->json(Jenis::where('id_kategori', $request->id_kategori)->get());
    }

    public function getTipe(Request $request)
    {
        return response()->json(Tipe::where('id_jenis', $request->id_jenis)->get());
    }
}
