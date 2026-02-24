<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UlangTahunController extends Controller
{
    public function ultah(Request $request)
    {
        // 1. Ambil input 'month' dari request, jika kosong gunakan bulan saat ini (Y-m)
        $month = $request->input('month', date('Y-m'));

        // 2. Pecah string 'YYYY-MM' untuk mendapatkan angka bulannya saja
        $carbonDate = Carbon::parse($month);
        $bulanAngka = $carbonDate->month; // Mengambil angka bulan (1-12)

        // 3. Query menggunakan Eloquent (lebih bersih)
        // Mencari user yang bulannya sama dengan input, diurutkan berdasarkan tanggal terkecil
        $hbd = User::whereMonth('tanggal_lahir', $bulanAngka)
            ->orderByRaw('DAY(tanggal_lahir) ASC')
            ->get();

        $title = 'Data Ulang Tahun Karyawan';
        $konf = DB::table('setting')->first();

        // 4. Return ke view dengan data yang sudah difilter
        return view('ulang_tahun.index', compact(
            'hbd',
            'title',
            'month',
            'konf'
        ));
    }
}
