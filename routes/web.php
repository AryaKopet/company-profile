<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\Dashboard;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [Dashboard::class, 'render'])->name('filament.pages.dashboard');

Route::get('/custom-box', [CustomerController::class, 'showStep1'])->name('customize.box.step1');
Route::post('/customize-box/step1', [CustomerController::class, 'submitStep1'])->name('customize.box.step1.submit');
Route::get('/customize-box/step-2', [CustomerController::class, 'step2'])->name('customize.step2');
Route::post('/customize-box/step-2', [CustomerController::class, 'storeStep2'])->name('customize.storeStep2');
Route::get('/custom-box/2', [CustomerController::class, 'showStep2'])->name('customize.box.step2');
Route::post('/customize-box/step2', [CustomerController::class, 'submitStep2'])->name('customize.box.step2.submit');

Route::middleware(['web'])->group(function() {
    Route::post('/submit-step1', [CustomerController::class, 'submitStep1'])->name('customize.box.step1.submit');
});

