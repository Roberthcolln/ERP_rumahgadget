<?php

use App\Http\Controllers\CheckoutController;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route untuk mendapatkan Kota berdasarkan Provinsi

Route::post('/midtrans/callback', [CheckoutController::class, 'notificationHandler']);
