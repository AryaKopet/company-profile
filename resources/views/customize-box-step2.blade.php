<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT.SHI - custom material</title>
    
    <!-- Tambahkan Favicon -->
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">

    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .gambar {
        width: 130px;
        height: 130px;
    }
</style>
<body>
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Custom Bahan dan Ukuran Box</h2>
    <form action="{{ route('customize.storeStep2') }}" method="POST" class="shadow-lg p-4 bg-white rounded">
        @csrf

        <!-- Pilih Bahan Material -->
        <div class="mb-4">
            <label for="material_id" class="form-label">Bahan Material</label>
            <select name="material_id" id="material_id" class="form-select" required>
                <option value="" disabled selected>Pilih Material</option>
                @foreach ($materials as $material)
                    <option value="{{ $material->id }}">{{ $material->barang }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Frame -->
        <div class="mb-4">
            <label for="frame_id" class="form-label">Frame</label>
            <select name="frame_id" id="frame_id" class="form-select" required>
                <option value="" disabled selected>Pilih Frame</option>
                @foreach ($frames as $frame)
                    <option value="{{ $frame->id }}">{{ $frame->barang }}</option>
                @endforeach
            </select>
        </div>

        <!-- Ukuran Box -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="panjang" class="form-label">Panjang (mm)</label>
                <input type="number" name="panjang" id="panjang" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="lebar" class="form-label">Lebar (mm)</label>
                <input type="number" name="lebar" id="lebar" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="tinggi" class="form-label">Tinggi (mm)</label>
                <input type="number" name="tinggi" id="tinggi" class="form-control" required>
            </div>
        </div>

        <!-- Tombol -->
        <div class="d-flex justify-content-between mt-4">
            <!-- Tombol Kembali -->
            <a href="{{ url('/') }}" class="btn btn-warning px-4 py-2">Kembali</a>
            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
        </div>
    </form>
</div>
@endsection
</body>
</html>