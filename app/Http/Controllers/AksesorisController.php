<?php

namespace App\Http\Controllers;

use App\Models\Aksesoris;
use App\Models\Gudang;
use App\Models\KategoriAksesoris;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk transaksi data

class AksesorisController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Aksesoris';
        $user = auth()->user();
        $idGudang = $user->gudangAkses();

        // Eager loading relasi varian dan warna agar muncul di index
        $query = Aksesoris::with(['kategori_aksesoris'])
            ->when($request->nama_aksesoris, fn($q) => $q->where('nama_aksesoris', 'like', '%' . $request->nama_aksesoris . '%'))
            ->when($request->id_kategori_aksesoris, fn($q) => $q->where('id_kategori_aksesoris', $request->id_kategori_aksesoris))
            ->when($request->id_supplier, fn($q) => $q->where('id_supplier', $request->id_supplier));

        if ($idGudang) {
            $query->whereHas('gudang', function ($q) use ($idGudang) {
                $q->where('gudang.id_gudang', $idGudang);
            });
        }
        $supplier = Supplier::where('status', 'aktif')->get();
        $aksesoris = $query->get();
        $kategori_aksesoris = KategoriAksesoris::all();


        return view('aksesoris.index', compact('title', 'aksesoris', 'kategori_aksesoris', 'supplier'));
    }

    public function create()
    {
        $title = 'Tambah Aksesoris';
        $kategori_aksesoris = KategoriAksesoris::all();
        $supplier = Supplier::where('status', 'aktif')->get();
        $user = auth()->user();
        $idGudang = $user->gudangAkses();

        $gudang = Gudang::where('status', 'aktif')
            ->when($idGudang, fn($q) => $q->where('id_gudang', $idGudang))
            ->get();

        return view('aksesoris.create', compact('title', 'kategori_aksesoris', 'gudang', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_aksesoris'        => 'required',
            'id_kategori_aksesoris' => 'required',
            'harga_aksesoris'       => 'required|numeric',
            'harga_jual_aksesoris'  => 'required|numeric',
            'id_gudang'             => 'required',
            'qty'                   => 'required|numeric|min:0',
            'gambar_aksesoris'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->all();

            if ($request->hasFile('gambar_aksesoris')) {
                $file = $request->file('gambar_aksesoris');
                $nama_file = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('file/aksesoris'), $nama_file);
                $data['gambar_aksesoris'] = $nama_file;
            }

            $aksesoris = Aksesoris::create($data);

            // Simpan stok ke pivot
            $aksesoris->gudang()->attach($request->id_gudang, ['qty' => $request->qty]);

            DB::commit();
            return redirect()->route('aksesoris.index')->with('Sukses', 'Data Aksesoris berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('Error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $aksesoris = Aksesoris::with('gudang')->findOrFail($id);
        $title = 'Edit Aksesoris';
        $kategori_aksesoris = KategoriAksesoris::all();
        $supplier = Supplier::where('status', 'aktif')->get();
        $idGudang = auth()->user()->gudangAkses();

        $gudang = Gudang::when($idGudang, fn($q) => $q->where('id_gudang', $idGudang))->get();

        return view('aksesoris.edit', compact('title', 'aksesoris', 'kategori_aksesoris', 'gudang', 'supplier'));
    }

    public function update(Request $request, $id)
    {
        $aksesoris = Aksesoris::findOrFail($id);

        $validated = $request->validate([
            'nama_aksesoris'        => 'required|string|max:255',
            'id_kategori_aksesoris' => 'required',
            'id_supplier'           => 'nullable',
            'deskripsi_aksesoris'   => 'nullable|string',
            'harga_aksesoris'       => 'required|numeric',
            'harga_jual_aksesoris'  => 'required|numeric',
            'harga_promo_aksesoris' => 'nullable|numeric',
            'id_gudang'             => 'required',
            'qty'                   => 'required|numeric',
            'gambar_aksesoris'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            DB::beginTransaction();

            if ($request->hasFile('gambar_aksesoris')) {
                // Hapus foto lama
                if ($aksesoris->gambar_aksesoris && File::exists(public_path('file/aksesoris/' . $aksesoris->gambar_aksesoris))) {
                    File::delete(public_path('file/aksesoris/' . $aksesoris->gambar_aksesoris));
                }

                $file = $request->file('gambar_aksesoris');
                $nama_file = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('file/aksesoris'), $nama_file);
                $validated['gambar_aksesoris'] = $nama_file;
            }

            $aksesoris->update($validated);

            // Update stok di gudang tertentu
            $aksesoris->gudang()->syncWithoutDetaching([
                $request->id_gudang => ['qty' => $request->qty]
            ]);

            DB::commit();
            return redirect()->route('aksesoris.index')->with('Sukses', 'Data Aksesoris berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('Error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $aksesoris = Aksesoris::findOrFail($id);

        // Hapus file gambar jika ada
        if ($aksesoris->gambar_aksesoris && file_exists(public_path('file/aksesoris/' . $aksesoris->gambar_aksesoris))) {
            unlink(public_path('file/aksesoris/' . $aksesoris->gambar_aksesoris));
        }

        $aksesoris->gudang()->detach();
        $aksesoris->delete();

        return redirect()->back()->with('Sukses', 'Berhasil Hapus Aksesoris');
    }
}
