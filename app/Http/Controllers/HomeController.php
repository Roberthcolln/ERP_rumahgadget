<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\KategoriService;
use App\Models\Produk;
use App\Models\Service;
use App\Models\Tipe;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

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

        // Ambil produk dengan relasi, filter pencarian (jika ada), dan batasi 6 data
        $produk = \App\Models\Produk::with(['kategori', 'jenis']) // Tambahkan 'jenis' untuk logika harga tadi
            ->when($q, function ($query) use ($q) {
                return $query->where('nama_produk', 'like', '%' . $q . '%');
            })
            ->limit(6) // Membatasi hanya 6 data
            ->get();

        // Ambil kategori unik untuk menu filter
        $kategori = \App\Models\Kategori::all();

        return view('welcome', compact('konf', 'produk', 'kategori'));
    }

    public function getDetailProduk($id)
    {
        $produk = \App\Models\Produk::with(['kategori', 'jenis', 'tipe', 'varian', 'warna'])
            ->findOrFail($id);

        return response()->json($produk);
    }

    public function addToCart(Request $request)
    {
        $id = $request->id_produk;
        $produk = \App\Models\Produk::findOrFail($id);

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nama" => $produk->nama_produk,
                "quantity" => 1,
                "harga" => ($produk->harga_promo_produk > 0) ? $produk->harga_promo_produk : $produk->harga_jual_produk,
                "gambar" => $produk->gambar_produk
            ];
        }

        Session::put('cart', $cart);
        return response()->json(['message' => 'Produk berhasil ditambah!', 'cart_count' => count($cart)]);
    }

    public function checkout()
    {
        $cart = Session::get('cart');
        if (!$cart) return redirect('/')->with('error', 'Keranjang kosong!');

        $konf = DB::table('setting')->first();
        return view('checkout', compact('cart', 'konf'));
    }

    public function prosesCheckout(Request $request)
    {
        $cart = Session::get('cart');
        $pesan = "Halo Admin, saya mau pesan:\n\n";

        foreach ($cart as $item) {
            $pesan .= "- " . $item['nama'] . " (" . $item['quantity'] . "x)\n";
        }

        $pesan .= "\nTotal: Rp " . number_format($this->getTotalHarga($cart));
        $pesan .= "\n\nData Pembeli:";
        $pesan .= "\nNama: " . $request->nama;
        $pesan .= "\nMetode: " . $request->metode_kirim;
        $pesan .= "\nAlamat: " . $request->alamat;

        $urlWa = "https://wa.me/6281xxx?text=" . urlencode($pesan);

        Session::forget('cart'); // Kosongkan keranjang
        return redirect($urlWa);
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

    public function tukarTambah(Request $request)
    {
        $konf = DB::table('setting')->first();

        // 1. HP Client: diambil dari produk dengan jenis tertentu
        $hpClient = Produk::with(['varian', 'jenis'])
            ->whereHas('jenis', function ($q) {
                $q->whereIn('nama_jenis', ['iPhone Ex iBox', 'iPhone Second', 'Android Second']);
            })->get();

        // 2. HP Pilihan (Target): Semua jenis produk
        $hpTarget = Produk::with(['varian', 'jenis'])->get();

        return view('tukar_tambah', compact('konf', 'hpClient', 'hpTarget'));
    }

    public function getProdukDetail($id)
    {
        $produk = Produk::with(['varian', 'jenis'])->find($id);
        if ($produk) {
            $waktuDb = $produk->updated_at ?: $produk->created_at;
            return Response::json([
                'success' => true,
                'id' => $produk->id_produk,
                'nama' => $produk->nama_produk,
                'varian' => $produk->varian->nama_varian ?? '-',
                'harga_raw' => $produk->harga_jual_produk,
                'harga_fmt' => 'Rp ' . number_format($produk->harga_jual_produk, 0, ',', '.'),
                'waktu' => $waktuDb ? $waktuDb->format('d/m/Y - H:i') : now()->format('d/m/Y - H:i')
            ]);
        }
        return response()->json(['success' => false], 404);
    }

    public function sewa(Request $request)
    {
        $konf = DB::table('setting')->first();
        $search = $request->input('search');

        // Ambil data sewa dengan relasi produk, varian, dan warna
        $sewa = \App\Models\SewaProduk::with(['produk.varian', 'produk.warna'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('produk', function ($q) use ($search) {
                    $q->where('nama_produk', 'LIKE', "%{$search}%");
                });
            })
            ->get();

        return view('sewa_view', compact('konf', 'sewa'));
    }

    public function artikel(Request $request)
    {
        $konf = DB::table('setting')->first();
        $q = $request->input('search');

        $artikels = Berita::when($q, function ($query) use ($q) {
            return $query->where('judul_berita', 'LIKE', "%{$q}%")
                ->orWhere('isi_berita', 'LIKE', "%{$q}%");
        })
            ->latest()
            ->paginate(9);

        return view('artikel_view', compact('konf', 'artikels'));
    }

    public function artikelDetail($slug)
    {
        $konf = DB::table('setting')->first();
        // Mencari berdasarkan slug_berita
        $artikel = Berita::where('slug_berita', $slug)->firstOrFail();

        // Ambil artikel lain sebagai rekomendasi
        $rekomendasi = Berita::where('id_berita', '!=', $artikel->id_berita)
            ->limit(5)->get();

        return view('artikel_detail', compact('konf', 'artikel', 'rekomendasi'));
    }
    // Tambahkan di HomeController atau RateCardController
    public function rateCardWeb()
    {
        $konf = DB::table('setting')->first();
        // Mengambil data rate card
        $ratecards = \App\Models\RateCard::orderBy('platform', 'asc')->get();

        return view('ratecard_view', compact('konf', 'ratecards'));
    }
}
