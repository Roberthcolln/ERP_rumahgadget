<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Layanan;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Berita';
        $berita = DB::table('berita')

            ->get();
        return view('berita.index', compact('title', 'berita'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->jabatan != 'Admin' && auth()->user()->id != 1) {
            return redirect()->route('berita.index')->with('error', 'Anda tidak memiliki akses untuk mengedit berita.');
        }
        $berita = Berita::all();
        $title = 'Tambah Berita';
        return view('berita.create', compact('title', 'berita'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute wajib diisi!!!',
        ];

        $request->validate([
            'judul_berita' => 'required',
            'isi_berita' => 'required',

            'gambar_berita' => 'required: jpg, jpeg, png, tfif, jfif, raw, gif, ai, psd',
        ], $message);
        $gambar_berita = $request->file('gambar_berita');
        $namagambarberita = 'Berita' . date('Ymdhis') . '.' . $request->file('gambar_berita')->getClientOriginalExtension();
        $gambar_berita->move('file/berita/', $namagambarberita);

        $berita = new Berita();
        $berita->judul_berita = $request->judul_berita;
        $berita->isi_berita = $request->isi_berita;

        $berita->gambar_berita = $namagambarberita;
        $berita->slug_berita = Str::slug($request->judul_berita);
        $berita->tanggal_berita = Carbon::now();
        $berita->save();
        return redirect()->route('berita.index')->with('Sukses', 'Berhasil Tambah Berita');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $berita = Berita::where('id_berita', $id)->firstOrFail();
        $title = $berita->judul_berita;
        return view('berita.show', compact('berita', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Logika: Jika BUKAN admin DAN BUKAN id 1, maka blokir
        if (auth()->user()->jabatan != 'Admin' && auth()->user()->id != 1) {
            return redirect()->route('berita.index')->with('error', 'Anda tidak memiliki akses untuk mengedit berita.');
        }

        $berita = Berita::find($id);
        $title = 'Edit Berita';
        return view('berita.edit', compact('berita', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->jabatan != 'Admin' && auth()->user()->id != 1) {
            abort(403, 'Unauthorized action.');
        }

        $berita = Berita::find($id);
        $namagambarberita = $berita->gambar_berita;
        $update = [
            'judul_berita' => $request->judul_berita,
            'isi_berita' => $request->isi_berita,

            'gambar_berita' => $namagambarberita,
            'tanggal_berita' => $berita->tanggal_berita,
            'slug_berita' => $berita->slug_berita,
        ];
        if ($request->gambar_berita != "") {
            $request->gambar_berita->move(public_path('file/berita/'), $namagambarberita);
        }
        $berita->update($update);
        return redirect()->route('berita.index')->with('Sukses', 'Berhasil Edit Berita');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (auth()->user()->jabatan != 'Admin' && auth()->user()->id != 1) {
            abort(403, 'Unauthorized action.');
        }

        $berita = Berita::find($id);
        $namafileberita = $berita->gambar_berita;
        $file_berita = public_path('file/berita/') . $namafileberita;
        if (file_exists($file_berita)) {
            @unlink($file_berita);
        }
        $berita->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Berita');
    }

    public function storeImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();

            // Buat nama file unik
            $fileName = $fileName . '_' . time() . '.' . $extension;

            // Pindahkan ke folder public/images
            $request->file('upload')->move(public_path('images'), $fileName);

            // URL untuk diakses di browser
            $url = asset('images/' . $fileName);

            // CKEditor 5 membutuhkan respons JSON seperti ini:
            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'Gagal mengunggah gambar.'
            ]
        ], 400);
    }
}
