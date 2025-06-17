<?php

use App\Filament\Pages\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PesananController;

// route awal halaman
Route::get('/', function () {
    return view('welcome');
});

// route jika alamat error atau tidak ditemukan
Route::fallback(function () {
    return view('error');
});

//route untuk user mengakses halaman collage data pelanggan (form 1)
Route::get('/custom-box', [CustomerController::class, 'showStep1'])->name('customize.box.step1');

// route untuk melakukan aksi submit dari form 1
Route::post('/customize-box-step1', [CustomerController::class, 'submitStep1'])->name('customize.box.step1.submit');

// route untuk user mengakses halaman customize box (form 2)
Route::get('/customize-box-step2', [CustomerController::class, 'showStep2'])->name('customize.box.step2');

// route untuk melakukan aksi submit dari form 2
Route::post('/custom-box/2', [CustomerController::class, 'submitStep2'])->name('customize.storeStep2');

// route untuk user mengakses halaman struk
Route::get('/generate-struk', [PesananController::class, 'generateStruk'])->name('generate.struk');

// route untuk melakukan aksi download struk
Route::get('/cetak-struk/{id}', [PesananController::class, 'cetakStruk'])->name('cetak.struk');

// route untuk admin mengakses halaman dashboard
Route::get('/admin/dashboard', [Dashboard::class, 'render'])->name('filament.pages.dashboard');

// route admin untuk melakukan aksi download struk pada dashboard
Route::get('/admin/cetak-struk/{id}', [\App\Http\Controllers\PesananController::class, 'adminCetakStruk'])
    ->name('admin.cetak.struk');
