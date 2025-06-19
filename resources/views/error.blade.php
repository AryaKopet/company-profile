<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>

    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to top right, #e0f2fe, #c7d2fe);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(#93c5fd 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.05;
            animation: move 60s linear infinite;
            z-index: 0;
        }

        @keyframes move {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 1000px 1000px;
            }
        }

        .error-box {
            position: relative;
            z-index: 2;
            max-width: 600px;
            width: 100%;
            padding: 40px;
            text-align: center;
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
            animation: fadeIn 0.8s ease-in-out;
        }

        .error-box img {
            width: 120px;
            margin-bottom: 15px;
            transition: transform 0.5s ease-in-out;
        }

        .error-box img:hover {
            transform: scale(1.1) rotate(3deg);
        }

        .error-box h1 {
            font-size: 100px;
            font-weight: bold;
            color: #3b82f6;
            margin-bottom: 10px;
        }

        .error-box p {
            font-size: 1.1rem;
            color: #4b5563;
            margin-bottom: 25px;
        }

        .btn-home {
            padding: 12px 28px;
            background: linear-gradient(to right, #6366f1, #3b82f6);
            color: white;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-home:hover {
            background: linear-gradient(to right, #4f46e5, #2563eb);
            transform: translateY(-2px);
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="particles"></div>

    <div class="error-box">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo PT SHI">
        <h1>404</h1>
        <p>Oops! Halaman yang Anda cari tidak ditemukan.<br>
            Coba periksa kembali URL atau kembali ke beranda.</p>
        <a href="{{ url('/') }}" class="btn-home">Kembali ke Beranda</a>
    </div>

    <!-- SVG Wave -->
    <div class="wave">
        <svg viewBox="0 0 1440 320" preserveAspectRatio="none" style="width:100%; height:100px;">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,160L80,154.7C160,149,320,139,480,160C640,181,800,235,960,240C1120,245,1280,203,1360,181.3L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
    </div>

</body>

</html>