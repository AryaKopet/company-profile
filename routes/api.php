<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('materials', App\Http\Controllers\Api\MaterialController::class);
Route::apiResource('pesanans', App\Http\Controllers\Api\PesananController::class);
Route::apiResource('pelanggans', App\Http\Controllers\Api\PelangganController::class);