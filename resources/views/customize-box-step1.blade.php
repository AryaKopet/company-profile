<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT.SHI - Input Data Diri</title>
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f9fafb, #eef1f5);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-wrapper {
            max-width: 500px;
            margin: 40px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 40px;
        }

        .form-wrapper .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-wrapper .form-header img {
            width: 160px;
            /* proporsional dengan form */
            height: auto;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-wrapper .form-header h4 {
            font-weight: 700;
            color: #333;
        }

        label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 15px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: #2f59d9;
        }

        .hidden {
            display: none;
        }

        .alert {
            border-radius: 8px;
        }
    </style>
</head>

<body>

    @extends('layouts.app')

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
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

    <div class="form-wrapper">
        <div class="form-header">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo PT SHI">
            <h4>Tolong inputkan data anda</h4>
        </div>

        <form action="{{ route('customize.box.step1.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama anda" required>
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email anda" required>
                @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone">Telepon/Whatsapp</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Masukkan nomor telepon anda" required>
            </div>

            <div class="mb-3">
                <label for="location">Lokasi</label>
                <select name="location" id="location" class="form-select" required>
                    <option value="" disabled selected>Pilih lokasi anda</option>
                    <option value="jabodetabek">Jabodetabek</option>
                    <option value="luar">Luar (Jabodetabek)</option>
                </select>
            </div>

            <div class="mb-3 hidden" id="provinsi-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" name="provinsi" id="provinsi" class="form-control" placeholder="Masukkan provinsi anda">
            </div>

            <div class="mb-3 hidden" id="kota-group">
                <label for="kota">Kota/Kabupaten</label>
                <input type="text" name="kota" id="kota" class="form-control" placeholder="Masukkan kota/kabupaten anda">
            </div>

            <div class="mb-3 hidden" id="alamat-group">
                <label for="alamat">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Masukkan alamat lengkap anda"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Next</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const locationSelect = document.getElementById('location');
        const provinsiGroup = document.getElementById('provinsi-group');
        const kotaGroup = document.getElementById('kota-group');
        const alamatGroup = document.getElementById('alamat-group');

        locationSelect.addEventListener('change', function() {
            const show = this.value === 'luar';
            [provinsiGroup, kotaGroup, alamatGroup].forEach(el => el.classList.toggle('hidden', !show));
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            if (locationSelect.value === 'luar') {
                const provinsi = document.getElementById('provinsi').value.trim();
                const kota = document.getElementById('kota').value.trim();
                const alamat = document.getElementById('alamat').value.trim();
                if (!provinsi || !kota || !alamat) {
                    alert("Mohon lengkapi data Provinsi, Kota/Kabupaten, dan Alamat.");
                    e.preventDefault();
                }
            }
        });
    </script>
</body>

</html>