<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #ffffff, #f1f5f9);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .error-box {
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
            max-width: 500px;
            width: 90%;
        }

        .error-box img {
            width: 80px;
            margin-bottom: 20px;
        }

        .error-box h1 {
            font-size: 96px;
            font-weight: 800;
            color: #ff6f61;
            margin: 0;
        }

        .error-box p {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .btn-home {
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-home:hover {
            background-color: #2f59d9;
        }
    </style>
</head>

<body>

    <div class="error-box">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo PT SHI">
        <h1>404</h1>
        <p>Oops! Halaman yang Anda cari tidak ditemukan.<br>Coba periksa kembali URL atau kembali ke beranda.</p>
        <a href="{{ url('/') }}" class="btn-home">Kembali ke Beranda</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>