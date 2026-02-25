<?php


use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\GudangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;

use App\Http\Controllers\KategoriController;

use App\Http\Controllers\PelangganController;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\VarianController;
use App\Http\Controllers\WarnaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/harga', [HomeController::class, 'harga'])->name('harga');

Route::get('/get-jenis-filter', [HomeController::class, 'getJenis'])->name('getJenisFilter');
Route::get('/get-tipe-filter', [HomeController::class, 'getTipe'])->name('getTipeFilter');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');

    Route::resource('setting', SettingController::class);
    Route::post('image-upload', [SettingController::class, 'storeImage'])->name('image.upload');
    Route::resource('dashboard', DashboardController::class);

    Route::resource('kategori', KategoriController::class);
    Route::resource('jenis', JenisController::class);
    Route::resource('tipe', TipeController::class);
    Route::resource('varian', VarianController::class);
    Route::resource('warna', WarnaController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('gudang', GudangController::class);


    Route::resource('supplier', SupplierController::class);
    Route::resource('pelanggan', PelangganController::class);


    Route::get('/fetch-jenis', [TipeController::class, 'fetchJenis']);
    Route::get('/fetch-tipe', [TipeController::class, 'fetchTipe']);;



    // Group 1: Bisa diakses semua User yang sudah login (Hanya Lihat)
    Route::middleware(['auth'])->group(function () {
        Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('/berita/show/{id}', [BeritaController::class, 'show'])->name('berita.show');
    });

    // Group 2: Hanya bisa diakses Admin atau ID 1 (Kelola Data)
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
        Route::post('/berita/store', [BeritaController::class, 'store'])->name('berita.store');
        Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');

        // Fitur upload gambar CKEditor juga biasanya hanya untuk admin
        Route::post('/berita/upload-image', [BeritaController::class, 'storeImage'])->name('berita.upload');
    });
});
