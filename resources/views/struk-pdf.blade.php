<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Penawaran</title>
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .header h1 {
            font-size: 22px;
            margin: 10px 0;
        }
        .header p {
            font-size: 14px;
            color: #555;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }
        ul {
            padding-left: 20px;
        }
        ul li {
            font-size: 14px;
        }
        .total {
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }
        .date {
            text-align: right;
            font-size: 12px;
            margin-bottom: 20px;
            color: #555;
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
        <p>Nomor Surat: {{ $strukData['nomor_struk'] }}</p>

        <h2 class="section-title">Data Pelanggan</h2>
        <ul>
            <li>Nama: {{ $strukData['customer']['nama'] }}</li>
            <li>Email: {{ $strukData['customer']['email'] }}</li>
            <li>No Telepon: {{ $strukData['customer']['no_telepon'] }}</li>
            <li>Lokasi: {{ $strukData['customer']['lokasi'] }}</li>
        </ul>

        <h2 class="section-title">Data Customisasi Box</h2>
        <ul>
            <li>Nama Projek/Box/Partisi: {{ $strukData['customization']['nama_box'] }}</li>
            <li>Material: {{ $strukData['customization']['material_name'] }}</li>
            <li>Frame: {{ $strukData['customization']['frame_name'] }}</li>
            <li>Ukuran:
                <ul>
                    <li>Panjang: {{ $strukData['customization']['panjang'] }} mm</li>
                    <li>Lebar: {{ $strukData['customization']['lebar'] }} mm</li>
                    <li>Tinggi: {{ $strukData['customization']['tinggi'] }} mm</li>
                </ul>
            </li>
        </ul>

        <h2 class="total">Total Harga: Rp {{ number_format($strukData['total_harga'], 0, ',', '.') }}</h2>
        <small>
        <p><strong>Note:</strong> Harga pada surat penawaran ini bisa berubah sewaktu-waktu, karena harga <br>pada surat penawaran ini belum merupakan harga final dari produksi box</p>
        </small>
    </div>
</body>
</html>
