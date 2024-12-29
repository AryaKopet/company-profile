<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tambahkan Style Custom -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .error-container {
            text-align: center;
        }
        .error-code {
            font-size: 6rem;
            font-weight: bold;
            color: #ff6f61;
        }
        .error-message {
            font-size: 1.5rem;
            margin: 20px 0;
            color: #6c757d;
        }
        .btn-home {
            background-color: #ff6f61;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-home:hover {
            background-color: #CA5C53FF;
            color: white;
        }
    </style>
</head>
<body>

    <div class="error-container">
        <!-- Kode dan Pesan Error -->
        <div class="error-code">404</div>
        <div class="error-message">Oops! Halaman yang Anda cari tidak ditemukan.</div>

        <!-- Tombol ke Beranda -->
        <a href="/" class="btn-home">Kembali ke Beranda</a>
    </div>

    <!-- Tambahkan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
