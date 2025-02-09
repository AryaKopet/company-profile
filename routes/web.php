<?php

use App\Filament\Pages\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PesananController;


Route::get('/', function () {
    return view('welcome');
}); // route awal halaman
Route::fallback(function(){
    return view('error');
}); // route alamat error

Route::get('/custom-box', [CustomerController::class, 'showStep1'])->name('customize.box.step1');
Route::post('/customize-box-step1', [CustomerController::class, 'submitStep1'])->name('customize.box.step1.submit');
Route::get('/customize-box-step2', [CustomerController::class, 'showStep2'])->name('customize.box.step2');
Route::post('/custom-box/2', [CustomerController::class, 'submitStep2'])->name('customize.storeStep2');
Route::get('/generate-struk', [PesananController::class, 'generateStruk'])->name('generate.struk');
Route::get('/admin/dashboard', [Dashboard::class, 'render'])->name('filament.pages.dashboard');
Route::get('/cetak-struk/{id}', [PesananController::class, 'cetakStruk'])->name('cetak.struk');


// Route::get('/custom-box', [CustomerController::class, 'showStep1'])->name('customize.box.step1');
// Route::post('/customize-box/step1', [CustomerController::class, 'submitStep1'])->name('customize.box.step1.submit');
// Route::get('/custom-box/2', [CustomerController::class, 'showStep2'])->name('customize.box.step2');
// Route::post('/customize/step2', [CustomerController::class, 'submitStep2'])->name('customize.storeStep2');
// Route::post('/generate-struk', [PesananController::class, 'generateStruk']);