<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Jenis;
use App\Models\Tipe;
use App\Models\Gudang;
use App\Models\Promo;
use App\Models\Supplier;
use App\Models\Varian;
use App\Models\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk transaksi data

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Produk';
        $user = auth()->user();
        $idGudang = $user->gudangAkses();

        // Eager loading relasi varian dan warna agar muncul di index
        $query = Produk::with(['kategori', 'jenis', 'tipe', 'gudang', 'supplier', 'varian', 'warna', 'promo'])
            ->when($request->nama_produk, fn($q) => $q->where('nama_produk', 'like', '%' . $request->nama_produk . '%'))
            ->when($request->id_kategori, fn($q) => $q->where('id_kategori', $request->id_kategori))
            ->when($request->id_supplier, fn($q) => $q->where('id_supplier', $request->id_supplier));

        if ($idGudang) {
            $query->whereHas('gudang', function ($q) use ($idGudang) {
                $q->where('gudang.id_gudang', $idGudang);
            });
        }

        $produk = $query->get();
        $kategori = Kategori::all();
        $supplier = Supplier::where('status', 'aktif')->get();

        return view('produk.index', compact('title', 'produk', 'kategori', 'supplier'));
    }

    public function create()
    {
        $title = 'Tambah Produk';
        $kategori = Kategori::all();
        $supplier = Supplier::where('status', 'aktif')->get();
        $varian = Varian::all();
        $warna = Warna::all();
        $user = auth()->user();
        $idGudang = $user->gudangAkses();
        $promo = Promo::where('status', 1)->get();
        $gudang = Gudang::where('status', 'aktif')
            ->when($idGudang, fn($q) => $q->where('id_gudang', $idGudang))
            ->get();

        return view('produk.create', compact('title', 'kategori', 'gudang', 'supplier', 'varian', 'warna', 'promo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk'       => 'required',
            'id_kategori'       => 'required',
            'id_jenis'          => 'required',
            'id_tipe'           => 'required',
            'id_varian'         => 'required',
            'id_warna'          => 'required',
            'harga_produk'      => 'required|numeric',
            'harga_jual_produk' => 'required|numeric',
            'id_gudang'         => 'required', // Wajib pilih gudang
            'qty'               => 'required|numeric|min:0', // Wajib isi stok awal
            'gambar_produk'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'id_promo' => 'nullable|exists:promo_gadget,id',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();

            if ($request->hasFile('gambar_produk')) {
                $file = $request->file('gambar_produk');
                $nama_file = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('file/produk'), $nama_file);
                $data['gambar_produk'] = $nama_file;
            }

            // 1. Simpan data produk
            $produk = Produk::create($data);

            // 2. Simpan stok ke tabel pivot (gudang_produk)
            // Pastikan relasi di model Produk adalah belongsToMany(Gudang::class)->withPivot('qty')
            $produk->gudang()->attach($request->id_gudang, [
                'qty' => $request->qty
            ]);

            DB::commit();
            return redirect()->route('produk.index')->with('Sukses', 'Produk dan Stok awal berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('Error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $title = 'Detail Produk';
        // Eager load semua relasi termasuk gudang (pivot untuk qty) dan promo
        $produk = Produk::with(['kategori', 'jenis', 'tipe', 'gudang', 'supplier', 'varian', 'warna', 'promo'])
            ->findOrFail($id);

        return view('produk.show', compact('title', 'produk'));
    }

    public function edit($id)
    {
        $produk = Produk::with('gudang')->findOrFail($id);
        $supplier = Supplier::where('status', 'aktif')->get();
        $title = 'Edit Produk';
        $varian = Varian::all();
        $warna = Warna::all();
        $kategori = Kategori::all();
        $jenis = Jenis::all();
        $tipe = Tipe::all();
        $promo = Promo::where('status', 1)->get();
        $user = auth()->user();
        $idGudang = $user->gudangAkses();

        $gudang = Gudang::when($idGudang, fn($q) => $q->where('id_gudang', $idGudang))->get();

        return view('produk.edit', compact(
            'title',
            'produk',
            'kategori',
            'jenis',
            'tipe',
            'gudang',
            'supplier',
            'warna',
            'varian',
            'promo'
        ));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $user = auth()->user();
        $idGudangUser = $user->gudangAkses();

        if ($idGudangUser && $request->id_gudang != $idGudangUser) {
            abort(403, 'Anda tidak memiliki akses ke gudang ini');
        }

        $validated = $request->validate([
            'nama_produk'       => 'required|string|max:255',
            'id_kategori'       => 'required',
            'id_jenis'          => 'required',
            'id_tipe'           => 'required',
            'id_varian'         => 'required',
            'id_warna'          => 'required',
            'deskripsi_produk'  => 'nullable|string',
            'harga_produk'      => 'nullable|numeric',
            'harga_promo_produk'      => 'nullable|numeric',
            'harga_jual_produk' => 'nullable|numeric',
            'id_gudang'         => 'required',
            'qty'               => 'required|numeric',
            'gambar_produk'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'id_promo' => 'nullable|exists:promo_gadget,id',
        ]);

        if ($request->hasFile('gambar_produk')) {
            if ($produk->gambar_produk && file_exists(public_path('file/produk/' . $produk->gambar_produk))) {
                unlink(public_path('file/produk/' . $produk->gambar_produk));
            }
            $file = $request->file('gambar_produk');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file/produk'), $nama_file);
            $validated['gambar_produk'] = $nama_file;
        }

        $produk->update($validated);

        // Menggunakan sync tanpa detaching agar data stok di gudang lain tidak hilang jika produk ada di banyak gudang
        if ($request->id_gudang) {
            $produk->gudang()->syncWithoutDetaching([
                $request->id_gudang => [
                    'qty' => $request->qty ?? 0
                ]
            ]);
        }

        return redirect()->route('produk.index')->with('Sukses', 'Berhasil Update Produk dan Stok');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus file gambar jika ada
        if ($produk->gambar_produk && file_exists(public_path('file/produk/' . $produk->gambar_produk))) {
            unlink(public_path('file/produk/' . $produk->gambar_produk));
        }

        $produk->gudang()->detach();
        $produk->delete();

        return redirect()->back()->with('Sukses', 'Berhasil Hapus Produk');
    }
}
