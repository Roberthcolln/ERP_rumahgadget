<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\KategoriService;
use App\Models\Musik;
use App\Models\Produk;
use App\Models\Service;
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
    // Update di Controller Anda
    public function index(Request $request)
    {
        $q = $request->q;
        $konf = DB::table('setting')->first();

        // Ambil semua produk, sertakan relasi kategori agar lebih efisien
        $produk = \App\Models\Produk::with('kategori')->get();

        // Ambil kategori unik untuk menu filter
        $kategori = \App\Models\Kategori::all();

        return view('welcome', compact('konf', 'produk', 'kategori'));
    }

    public function jual(Request $request)
    {
        $q = $request->q;
        $konf = DB::table('setting')->first();

        // Ambil semua produk, sertakan relasi kategori agar lebih efisien
        $produk = \App\Models\Produk::with('kategori')->get();

        // Ambil kategori unik untuk menu filter
        $kategori = \App\Models\Kategori::all();

        return view('jual', compact('konf', 'produk', 'kategori'));
    }

    public function cekHarga($id)
    {
        $produk = \App\Models\Produk::find($id);

        if ($produk) {
            // Ambil waktu dari updated_at, jika null gunakan created_at
            $waktuDb = $produk->updated_at ?: $produk->created_at;

            return response()->json([
                'success' => true,
                'harga' => 'Rp ' . number_format($produk->harga_jual_produk, 0, ',', '.'),
                'waktu' => $waktuDb ? $waktuDb->format('d/m/Y - H:i') . ' WITA' : now()->format('d/m/Y - H:i') . ' WITA'
            ]);
        }

        return response()->json(['success' => false], 404);
    }

    public function aksesoriss(Request $request)
    {
        $q = $request->search;
        $kat_id = $request->kategori; // Menangkap filter kategori dari URL
        $konf = DB::table('setting')->first();

        $query = \App\Models\Aksesoris::with('kategori_aksesoris');

        // Filter Pencarian
        $query->when($q, function ($query, $q) {
            return $query->where('nama_aksesoris', 'LIKE', '%' . $q . '%');
        });

        // Filter Kategori (Jika kategori dipilih di URL)
        $query->when($kat_id, function ($query, $kat_id) {
            return $query->where('id_kategori_aksesoris', $kat_id);
        });

        $aksesoris = $query->get();
        $kategori = \App\Models\KategoriAksesoris::all();

        return view('aksesoriss', compact('konf', 'aksesoris', 'kategori'));
    }

    public function harga(Request $request)
    {
        $konf = DB::table('setting')->first();
        $search = $request->input('search');
        $id_kategori = $request->input('kategori');
        $id_jenis = $request->input('jenis');

        // Tambahkan 'gudang' di WITH untuk mengambil data pivot qty
        $produk = Produk::with(['tipe', 'jenis', 'varian', 'warna', 'gudang'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_produk', 'LIKE', "%{$search}%")
                        ->orWhereHas('jenis', fn($j) => $j->where('nama_jenis', 'LIKE', "%{$search}%"));
                });
            })
            ->when($id_kategori, fn($q) => $q->where('id_kategori', $id_kategori))
            ->when($id_jenis, fn($q) => $q->where('id_jenis', $id_jenis))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Menambahkan property 'total_qty' secara dinamis ke setiap produk
        $produk->getCollection()->transform(function ($item) {
            $item->total_qty = $item->gudang->sum('pivot.qty');
            return $item;
        });

        $kategori = Kategori::all();
        $jenis = Jenis::when($id_kategori, fn($q) => $q->where('id_kategori', $id_kategori))->get();

        if ($request->ajax()) {
            return response()->json([
                'table' => view('partials._harga_table', compact('produk'))->render(),
                'sidebar' => view('partials._sidebar_jenis', compact('jenis'))->render(),
            ]);
        }

        return view('harga', compact('konf', 'produk', 'kategori', 'jenis'));
    }

    public function detail($id)
    {
        $p = Produk::with(['tipe', 'jenis', 'varian', 'warna', 'kategori'])->findOrFail($id);
        return view('partials._detail_produk', compact('p'))->render();
    }

    public function getJenis(Request $request)
    {
        return response()->json(Jenis::where('id_kategori', $request->id_kategori)->get());
    }

    public function getTipe(Request $request)
    {
        return response()->json(Tipe::where('id_jenis', $request->id_jenis)->get());
    }


    public function service(Request $request)
    {
        $konf = DB::table('setting')->first();
        $search = $request->input('search');
        $id_kategori = $request->input('id_kategori_service');

        $service = Service::with('kategori')
            ->when($search, function ($query) use ($search) {
                $query->where('type', 'LIKE', "%{$search}%")
                    ->orWhere('macbook', 'LIKE', "%{$search}%");
            })
            ->when($id_kategori, fn($q) => $q->where('id_kategori_service', $id_kategori))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $kategori_service = KategoriService::all();

        if ($request->ajax()) {
            return response()->json([
                'table' => view('partials._service_table', compact('service'))->render(),
            ]);
        }

        return view('web_service', compact('konf', 'service', 'kategori_service'));
    }

    public function detailService($id)
    {
        $s = Service::with('kategori')->findOrFail($id);
        return view('partials._detail_service', compact('s'))->render();
    }

    public function kredits(Request $request)
    {
        $konf = DB::table('setting')->first();
        $search = $request->input('search');
        $id_kategori = $request->input('kategori');
        $id_jenis = $request->input('jenis'); // Tangkap filter jenis

        $query = \App\Models\Kredit::with(['kategori', 'jenis', 'tipe', 'varian', 'warna']);

        // Filter Pencarian & Kategori
        $query->when($search, function ($q) use ($search) {
            $q->whereHas('tipe', fn($inner) => $inner->where('nama_tipe', 'LIKE', "%{$search}%"));
        })
            ->when($id_kategori, fn($q) => $q->where('id_kategori', $id_kategori))
            ->when($id_jenis, fn($q) => $q->where('id_jenis', $id_jenis));

        $kredit = $query->get()->groupBy('id_tipe');
        $kategori = Kategori::all();

        // Ambil daftar jenis/brand berdasarkan kategori yang dipilih untuk sidebar
        $jenis = Jenis::when($id_kategori, fn($q) => $q->where('id_kategori', $id_kategori))->get();

        // Jika request via AJAX (saat klik filter)
        if ($request->ajax()) {
            return response()->json([
                'table' => view('partials._kredit_table', compact('kredit'))->render(),
                'sidebar' => view('partials._sidebar_jenis', compact('jenis'))->render(),
            ]);
        }

        return view('kredits', compact('konf', 'kredit', 'kategori', 'jenis'));
    }
}
