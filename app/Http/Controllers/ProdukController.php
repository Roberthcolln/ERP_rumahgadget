<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Jenis;
use App\Models\Tipe;
use App\Models\Gudang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Data Produk';

        $user = auth()->user();
        $idGudang = $user->gudangAkses();

        $query = Produk::with(['kategori', 'jenis', 'tipe', 'gudang', 'supplier'])
            ->when(
                $request->nama_produk,
                fn($q) => $q->where('nama_produk', 'like', '%' . $request->nama_produk . '%')
            )
            ->when(
                $request->id_kategori,
                fn($q) => $q->where('id_kategori', $request->id_kategori)
            )
            ->when(
                $request->id_supplier,
                fn($q) => $q->where('id_supplier', $request->id_supplier)
            );

        // FILTER BERDASARKAN GUDANG USER
        if ($idGudang) {
            $query->whereHas('gudang', function ($q) use ($idGudang) {
                $q->where('gudang.id_gudang', $idGudang);
            });
        }

        $produk = $query->get();

        $kategori = Kategori::all();
        $supplier = Supplier::where('status', 'aktif')->get(); // TAMBAHAN

        return view('produk.index', compact('title', 'produk', 'kategori', 'supplier'));
    }


    public function create()
    {
        $title = 'Tambah Produk';
        $kategori = Kategori::all();
        $supplier = Supplier::where('status', 'aktif')->get();
        $user = auth()->user();
        $idGudang = $user->gudangAkses();

        // kasir hanya boleh pilih gudang tertentu
        $gudang = Gudang::where('status', 'aktif')
            ->when($idGudang, fn($q) => $q->where('id_gudang', $idGudang))
            ->get();

        return view('produk.create', compact('title', 'kategori', 'gudang', 'supplier'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'id_jenis' => 'required',
            'id_tipe' => 'required',
            'harga_produk' => 'required',
            'harga_jual_produk' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $nama_file = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file/produk'), $nama_file);
            $data['gambar_produk'] = $nama_file;
        }

        // Hanya buat produk, tanpa attach ke stok gudang di sini
        Produk::create($data);

        return redirect()->route('produk.index')->with('Sukses', 'Produk berhasil didaftarkan. Silahkan input stok di menu Barang Masuk.');
    }


    public function edit($id)
    {
        $produk = Produk::with('gudang')->findOrFail($id);
        $supplier = Supplier::where('status', 'aktif')->get();
        $title = 'Edit Produk';

        $kategori = Kategori::all();
        $jenis = Jenis::all();
        $tipe = Tipe::all();

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
            'supplier'
        ));
    }


    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $user = auth()->user();
        $idGudangUser = $user->gudangAkses();

        // Validasi akses gudang
        if ($idGudangUser && $request->id_gudang != $idGudangUser) {
            abort(403, 'Anda tidak memiliki akses ke gudang ini');
        }

        // Validasi data
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'id_kategori' => 'required',
            'id_jenis' => 'required',
            'id_tipe' => 'required',
            'deskripsi_produk' => 'nullable|string',
            'harga_produk' => 'nullable|numeric',
            'harga_jual_produk' => 'nullable|numeric',
            'harga_promo_produk' => 'nullable|numeric',
            'id_gudang' => 'nullable',
            'id_supplier' => 'nullable',
            'qty' => 'nullable|numeric',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload gambar baru
        if ($request->hasFile('gambar_produk')) {

            // Hapus gambar lama
            if ($produk->gambar_produk && file_exists(public_path('file/produk/' . $produk->gambar_produk))) {
                unlink(public_path('file/produk/' . $produk->gambar_produk));
            }

            $file = $request->file('gambar_produk');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file/produk'), $nama_file);

            $validated['gambar_produk'] = $nama_file;
        }

        // Update produk
        $produk->update($validated);

        // Update stok gudang
        if ($request->id_gudang) {
            $produk->gudang()->syncWithoutDetaching([
                $request->id_gudang => [
                    'qty' => $request->qty ?? 0
                ]
            ]);
        }

        return redirect()
            ->route('produk.index')
            ->with('Sukses', 'Berhasil Update Produk');
    }


    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        $produk->gudang()->detach();
        $produk->delete();

        return redirect()->back()
            ->with('Sukses', 'Berhasil Hapus Produk');
    }
}
