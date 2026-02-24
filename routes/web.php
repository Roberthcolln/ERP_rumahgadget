<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAdmin;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KategoriAnggotaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OfferingLetterController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\PusatController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SlipGajiController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\TransaksiStokController;
use App\Http\Controllers\UlangTahunController;

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
    Route::resource('produk', ProdukController::class);
    Route::resource('gudang', GudangController::class);

    Route::resource('anggota', AnggotaController::class);
    Route::resource('data_admin', DataAdmin::class);
    Route::resource('kategori_anggota', KategoriAnggotaController::class);
    Route::resource('departement', DepartementController::class);
    Route::resource('divisi', DivisiController::class);
    Route::resource('pusat', PusatController::class);
    Route::resource('region', RegionController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('slip-gaji', SlipGajiController::class);
    Route::resource('berita', BeritaController::class);
    Route::resource('provinsi', ProvinsiController::class);
    Route::resource('kota', KotaController::class);
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('kelurahan', KelurahanController::class);

    Route::post('image-upload', [BeritaController::class, 'storeImage'])->name('image.upload');

    Route::get(
        'slip-gaji/{id}/print',
        [SlipGajiController::class, 'printPdf']
    )->name('slip-gaji.print');

    Route::get('pos', [POSController::class, 'index'])->name('pos.index');
    Route::post('pos/checkout', [POSController::class, 'checkout'])->name('pos.checkout');
    Route::get('pos/batal/{id}', [POSController::class, 'batal'])->name('pos.batal');
    Route::get('/pos/print/{id}', [PosController::class, 'print'])
        ->name('pos.print');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/filter', [LaporanController::class, 'filter'])->name('laporan.filter');
    Route::get('/laporan/pdf', [LaporanController::class, 'exportPDF'])->name('laporan.pdf');

    Route::resource('ulang_tahun', UlangTahunController::class);
    Route::get('ulang_tahun', [UlangTahunController::class, 'ultah']);

    Route::resource('offering-letter', OfferingLetterController::class);
    Route::get('offering-letter/{id}/print', [OfferingLetterController::class, 'printPdf'])->name('offering-letter.print');

    Route::get('/fetch-jenis', [TipeController::class, 'fetchJenis']);
    Route::get('/fetch-tipe', [TipeController::class, 'fetchTipe']);
    Route::get('/fetch-region', [PusatController::class, 'fetchRegion'])->name('fetch-region');

    // UBAH DARI GET MENJADI POST
    Route::post('/fetch-kota', [KelurahanController::class, 'fetchKota']);
    Route::post('/fetch-kecamatan', [KelurahanController::class, 'fetchKecamatan']);

    // Jika Anda membutuhkan fetch-lurah juga, pastikan konsisten
    Route::post('/fetch-lurah', [KelurahanController::class, 'fetchLurah']);



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

    Route::middleware(['auth'])->group(function () {
        // History Transaksi
        Route::get('/stok/history', [TransaksiStokController::class, 'index'])->name('stok.history');

        // Barang Masuk
        Route::get('/stok/masuk', [TransaksiStokController::class, 'createMasuk'])->name('stok.masuk');
        Route::post('/stok/masuk', [TransaksiStokController::class, 'storeMasuk'])->name('stok.masuk.store');

        // Barang Keluar (Logikanya sama tinggal dikurangi stoknya)
        Route::get('/stok/keluar', [TransaksiStokController::class, 'createKeluar'])->name('stok.keluar');
        Route::post('/stok/keluar', [TransaksiStokController::class, 'storeKeluar'])->name('stok.keluar.store');
        Route::resource('stok', StokController::class);
    });

    Route::get('/get-users-by-gudang/{id_gudang}', [TransaksiStokController::class, 'getUsersSesuaiGudang'])
        ->name('stok.getUsersByGudang');
});
