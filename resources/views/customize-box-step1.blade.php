<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT.SHI - input data diri</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .gambar {
            width: 180px;
            height: 150px;
        }

        body {
            background-color: #FBF5DD;
        }

        .form-isian {
            margin-top: -45px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    @extends('layouts.app')
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = "{{ session('success') }}";
            alert(successMessage);
            setTimeout(function() {
                window.location.href = "{{ route('customize.box.step2') }}";
            }, 1000);
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
            <div class="col-md-6 form-isian">
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
                                @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Telepon -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telepon/Whatsapp</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Masukkan nomor telepon/whatsapp anda" required>
                            </div>

                            <!-- Lokasi -->
                            <div class="mb-3">
                                <label for="location" class="form-label">Lokasi</label>
                                <select name="location" id="location" class="form-select" required>
                                    <option value="" disabled selected>Pilih lokasi anda</option>
                                    <option value="jabodetabek">Jabodetabek</option>
                                    <option value="luar">Luar (Jabodetabek)</option>
                                </select>
                            </div>

                            <!-- Provinsi -->
                            <div class="mb-3 hidden" id="provinsi-group">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" id="provinsi" class="form-control" placeholder="Masukkan provinsi anda">
                            </div>

                            <!-- Kota/Kabupaten -->
                            <div class="mb-3 hidden" id="kota-group">
                                <label for="kota" class="form-label">Kota/Kabupaten</label>
                                <input type="text" name="kota" id="kota" class="form-control" placeholder="Masukkan kota/kabupaten anda">
                            </div>

                            <!-- Alamat Lengkap -->
                            <div class="mb-3 hidden" id="alamat-group">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap anda"></textarea>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!-- Bootstrap JS + Logic JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const locationSelect = document.getElementById('location');
        const provinsiGroup = document.getElementById('provinsi-group');
        const kotaGroup = document.getElementById('kota-group');
        const alamatGroup = document.getElementById('alamat-group');

        locationSelect.addEventListener('change', function() {
            if (this.value === 'luar') {
                provinsiGroup.classList.remove('hidden');
                kotaGroup.classList.remove('hidden');
                alamatGroup.classList.remove('hidden');
            } else {
                provinsiGroup.classList.add('hidden');
                kotaGroup.classList.add('hidden');
                alamatGroup.classList.add('hidden');
            }
        });
        document.querySelector('form').addEventListener('submit', function(e) {
            const locationValue = locationSelect.value;

            if (locationValue === 'luar') {
                const provinsi = document.getElementById('provinsi').value.trim();
                const kota = document.getElementById('kota').value.trim();
                const alamat = document.getElementById('alamat').value.trim();

                if (!provinsi || !kota || !alamat) {
                    alert("Mohon lengkapi data Provinsi, Kota/Kabupaten, dan Alamat.");
                    e.preventDefault(); // Hentikan submit form
                }
            }
        });
    </script>
</body>

</html>