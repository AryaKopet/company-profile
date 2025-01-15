<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pemesanan</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            background: #fff;
            margin: 30px auto;
            padding: 20px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 120px;
        }
        .header h1 {
            font-size: 26px;
            margin: 10px 0;
            font-weight: bold;
        }
        .header p {
            font-size: 14px;
            color: #555;
        }
        .date {
            text-align: right;
            font-size: 14px;
            margin-bottom: 20px;
            color: #555;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            color: #333;
        }
        .content ul {
            padding-left: 20px;
        }
        .content ul li {
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        .buttons {
            margin-top: 30px;
            text-align: center;
        }
        .buttons .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo">
            <h1>PT. Sugi Harti Indonesia</h1>
            <p>Jl. M.Hasibuan - Bekasi Selatan 17141</p>
        </div>
        <hr>
        <div class="date">
            <p>Tanggal: {{ now()->format('d-m-Y') }}</p>
        </div>
        <p>Nomor Struk: {{ $strukData['nomor_struk'] }}</p>
        <div class="content">
            <p>Kepada Yth,</p>
            <p>Bapak/Ibu {{ $strukData['customer']['nama'] }}</p>
            <p>Terima kasih atas kunjungan Anda ke website kami. Berikut adalah detail pemesanan Anda:</p>

            <h2 class="section-title">Data Pelanggan</h2>
            <ul>
                <li>Nama: {{ $strukData['customer']['nama'] }}</li>
                <li>Email: {{ $strukData['customer']['email'] }}</li>
                <li>No Telepon: {{ $strukData['customer']['no_telepon'] }}</li>
                <li>Lokasi: {{ $strukData['customer']['lokasi'] }}</li>
            </ul>

            <h2 class="section-title">Data Customisasi Box</h2>
            <ul>
                <li>Material: {{ $strukData['customization']['material_name'] ?? 'Tidak tersedia' }}</li>
                <li>Frame: {{ $strukData['customization']['frame_name'] ?? 'Tidak tersedia' }}</li>
                <li>Ukuran:
                    <ul>
                        <li>Panjang {{ $strukData['customization']['panjang'] }} mm</li>
                        <li>Lebar {{ $strukData['customization']['lebar'] }} mm</li>
                        <li>Tinggi {{ $strukData['customization']['tinggi'] }} mm</li>
                    </ul>
                </li>
            </ul>

            <h2 class="total">Total Harga: Rp {{ number_format($strukData['total_harga'], 0, ',', '.') }}</h2>

            <p>Jika ada pertanyaan lebih lanjut, hubungi kami melalui email <a href="mailto:admin@pt-shi.com">admin@pt-shi.com</a>.</p>
        </div>
        <div class="buttons">
            <a href="{{ url('/') }}" class="btn btn-secondary me-2 px-4 py-2">Selesai</a>
            <a href="{{ route('cetak.struk', ['id' => $strukData['customer']['email']]) }}" class="btn btn-primary">Cetak Struk</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
