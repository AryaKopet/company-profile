<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT.SHI - input data diri</title>
    
    <!-- Tambahkan Favicon -->
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">

    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .gambar {
        width: 180px;
        height: 150px;
    }
</style>
<body>
    <!-- Cek jika ada notifikasi sukses -->
    @extends('layouts.app')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Menggunakan JSON.stringify() di JavaScript untuk menghindari masalah dengan karakter khusus
                var successMessage = "{{ session('success') }}";
                alert(successMessage); // Menampilkan pop-up notifikasi
                setTimeout(function() {
                    window.location.href = "{{ route('customize.box.step2') }}";
                }, 1000); // Tunggu 1 detik sebelum pindah halaman
            });
        </script>
    @endif
    <div class="container d-flex justify-content-center align-items-center">
        <div class="gambar">
            <img src="{{ asset('assets/logo.png') }}" alt="PT. Sugi Harti Indonesia" class="gambar">
        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-center">Tolong inputkan data anda</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customize.box.step1.submit') }}" method="POST">
                            @csrf
                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama anda" required>
                            </div>
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email anda" required>
                            </div>
                            
                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telepon/Whatsapp</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Masukkan nomor telepon/whatsapp anda" required>
                            </div>
                            
                            <!-- Location -->
                            <div class="mb-3">
                                <label for="location" class="form-label">Lokasi</label>
                                <select name="location" id="location" class="form-select" required>
                                    <option value="" disabled selected>pilih lokasi anda</option>
                                    <option value="jabodetabek">Jabodetabek</option>
                                    <option value="luar">Luar</option>
                                </select>
                            </div>

                            <!-- Button Next -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
