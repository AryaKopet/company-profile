<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [Dashboard::class, 'render'])->name('filament.pages.dashboard');
