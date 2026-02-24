<?php

use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route untuk mendapatkan Kota berdasarkan Provinsi
Route::get('/get-kota/{id_provinsi}', function ($id_provinsi) {
    // Pastikan kolom di tabel kota adalah 'id_provinsi'
    return Kota::where('id_provinsi', $id_provinsi)
        ->orderBy('nama_kota', 'asc')
        ->get();
});

// Route untuk mendapatkan Kecamatan berdasarkan Kota
Route::get('/get-kecamatan/{id_kota}', function ($id_kota) {
    // Pastikan kolom di tabel kecamatan adalah 'id_kota'
    return Kecamatan::where('id_kota', $id_kota)
        ->orderBy('nama_kecamatan', 'asc')
        ->get();
});

Route::get('/get-kelurahan/{id_kecamatan}', function ($id_kecamatan) {
    // Pastikan kolom di tabel kelurahan adalah 'id_kecamatan'
    return Kelurahan::where('id_kecamatan', $id_kecamatan)
        ->orderBy('nama_kelurahan', 'asc')
        ->get();
});
