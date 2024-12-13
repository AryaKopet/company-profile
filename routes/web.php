<?php

use App\Filament\Pages\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/custom-box', [CustomerController::class, 'showStep1'])->name('customize.box.step1');
Route::post('/customize-box/step1', [CustomerController::class, 'submitStep1'])->name('customize.box.step1.submit');
Route::get('/custom-box/2', [CustomerController::class, 'showStep2'])->name('customize.box.step2');
Route::post('/customize-box/step2', [CustomerController::class, 'submitStep2'])->name('customize.storeStep2');
Route::get('/admin/dashboard', [Dashboard::class, 'render'])->name('filament.pages.dashboard');


