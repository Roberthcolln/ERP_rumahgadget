<?php

namespace App\Http\Controllers;


use App\Models\KategoriAnggota;
use App\Models\Departement;
use App\Models\Divisi;
use App\Models\Pusat;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Karyawan';
        $user = auth()->user();

        // Ambil data region untuk dropdown filter
        $regions = DB::table('region')->get();

        $query = DB::table('users')
            ->join('region', 'users.id_region', '=', 'region.id_region')
            ->select([
                'users.*',
                'region.nama_region'
            ]);

        // ================= PEMBARUAN ROLE ACCESS =================
        // Jika BUKAN admin DAN BUKAN HRD, maka hanya bisa melihat data diri sendiri
        if (!$user || ($user->is_admin != 1 && $user->jabatan != 'HRD')) {
            $query->where('users.id', $user->id);
        }
        // =========================================================

        // Global Search
        $search = $request->input('search');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('users.no_hp', 'like', "%{$search}%");
            });
        }

        // Filter Status (Verifikasi / Non Verifikasi)
        $status = $request->input('status');
        if (!empty($status)) {
            $query->where('users.status', $status);
        }

        // Filter Region
        $id_region = $request->input('id_region');
        if (!empty($id_region)) {
            $query->where('users.id_region', $id_region);
        }

        // Pagination
        $anggota = $query
            ->orderByDesc('users.id')
            ->paginate(10)
            ->withQueryString();

        return view('anggota.index', compact('title', 'anggota', 'regions'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_anggota = KategoriAnggota::all();
        $departement = Departement::all();
        $divisi = Divisi::all();
        $title = 'Tambah Data Karyawan';
        $pusat = Pusat::all();
        $region = Region::all();
        return view('anggota.create', compact('title', 'pusat', 'departement', 'region', 'kategori_anggota', 'divisi',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:8',
            'no_hp' => 'required',
            'id_departement' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'tanggal_gabung' => 'required',
            'id_kategori_anggota' => 'required',
            'nik' => 'required',
            'id_pusat' => 'required',
            'id_region' => 'required'
        ]);

        // Upload Foto (Opsional)
        $namafoto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namafoto = 'Foto' . date('YmdHis') . '.' . $foto->getClientOriginalExtension();
            $foto->move('file/foto/', $namafoto);
        }

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->no_hp = $request->no_hp;

        $data->alamat = $request->alamat;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->tanggal_gabung = $request->tanggal_gabung;
        $data->id_kategori_anggota = $request->id_kategori_anggota;
        $data->id_departement = $request->id_departement;
        $data->status = 'Verifikasi';
        $data->nik = $request->nik;

        // field ini ada di view
        $data->id_divisi = $request->id_divisi;
        $data->jabatan = $request->jabatan;
        $data->id_pusat = $request->id_pusat;
        $data->id_region = $request->id_region;

        // field opsional, bisa null
        $data->foto = $namafoto;

        $data->save();
        return redirect()->route('anggota.index')->with('Sukses', 'Berhasil Tambah Karyawan Baru');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $anggota = DB::table('users')
            ->join('kategori_anggota', 'users.id_kategori_anggota', 'kategori_anggota.id_kategori_anggota')
            ->join('departement', 'users.id_departement', 'departement.id_departement')
            ->join('pusat', 'users.id_pusat', 'pusat.id_pusat')
            ->join('region', 'users.id_region', 'region.id_region')
            ->join('divisi', 'users.id_divisi', 'divisi.id_divisi')

            ->where('users.id', $id)
            ->first();
        $title = 'Detail Data';
        return view('anggota.show', compact('title', 'anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori_anggota = KategoriAnggota::all();
        $departement = Departement::all();
        $divisi = Divisi::all();

        $anggota = User::find($id);
        $pusat = Pusat::all();
        $region = Region::all();

        $title = 'Edit Anggota';
        return view('anggota.edit', compact('pusat', 'departement', 'region', 'anggota', 'title', 'kategori_anggota', 'divisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = User::findorfail($id);
        $namafoto = $data->foto;
        $kategori = DB::table('kategori_anggota')->where('id_kategori_anggota', $request->id_kategori_anggota)->first();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->no_hp = $request->no_hp;

        $data->alamat = $request->alamat;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->tanggal_gabung = $request->tanggal_gabung;
        $data->id_kategori_anggota = $request->id_kategori_anggota;
        $data->status = $data->status;
        $data->nik = $request->nik;
        $data->id_divisi = $request->id_divisi;
        $data->id_departement = $request->id_departement;
        $data->jabatan = $request->jabatan;
        $data->id_pusat = $request->id_pusat;
        $data->id_region = $request->id_region;

        $data->foto = $namafoto;

        if ($request->password != "") {
            $data->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {

            // hapus foto lama (jika ada)
            if ($data->foto && file_exists(public_path('file/foto/' . $data->foto))) {
                unlink(public_path('file/foto/' . $data->foto));
            }

            // upload foto baru dengan nama unik
            $foto = $request->file('foto');
            $namafoto = 'Foto_' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move('file/foto/', $namafoto);

            $data->foto = $namafoto;
        }


        $data->save();
        return redirect()->route('anggota.index')->with('Sukses', 'Berhasil Edit Data Karyawan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anggota = User::find($id);
        $anggota->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Anggota');
    }

    public function print($id)
    {
        $anggota = DB::table('users')
            ->leftJoin('kategori_anggota', 'users.id_kategori_anggota', 'kategori_anggota.id_kategori_anggota')
            ->leftJoin('region', 'users.id_region', 'region.id_region')
            ->leftJoin('chapter', 'users.id_chapter', 'chapter.id_chapter')
            ->where('users.id', $id)
            ->first();

        if (!$anggota) {
            abort(404, "Data anggota tidak ditemukan");
        }

        return view('anggota.cetak-kartu', compact('anggota'));
    }
}
