<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pemesanan</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
</head>
<body>
    <h1>Struk Pemesanan</h1>
    <p>Terima kasih atas kunjungan Anda ke website kami.</p>
    <p>Berikut adalah data yang telah diverifikasi:</p>

    <h2>Data Pelanggan</h2>
    <ul>
        <li>Nama: {{ $strukData['customer']['nama'] }}</li>
        <li>Email: {{ $strukData['customer']['email'] }}</li>
        <li>No Telepon: {{ $strukData['customer']['no_telepon'] }}</li>
        <li>Lokasi: {{ $strukData['customer']['lokasi'] }}</li>
    </ul>

    <h2>Data Customisasi Box</h2>
    <ul>
        <li>Material: {{ $strukData['customization']['material_id'] }}</li>
        <li>Frame: {{ $strukData['customization']['frame_id'] }}</li>
        <li>Ukuran: {{ $strukData['customization']['panjang'] }} x {{ $strukData['customization']['lebar'] }} x {{ $strukData['customization']['tinggi'] }}</li>
    </ul>

    <h2>Total Harga</h2>
    <p>Rp {{ number_format($strukData['total_harga'], 0, ',', '.') }}</p>

    <p>Hubungi admin kami di <a href="mailto:admin@pt-shi.com">admin@pt-shi.com</a> untuk informasi lebih lanjut.</p>
</body>
</html>
