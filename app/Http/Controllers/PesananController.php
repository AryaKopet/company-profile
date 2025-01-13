<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Pelanggan;

class PesananController extends Controller
{
    public function generateStruk(Request $request)
{
    // Data pelanggan
    $customer = [
        'nama' => Pelanggan::where('email', $request->email)->value('nama'),
        'email' => $request->email,
        'no_telepon' => Pelanggan::where('email', $request->email)->value('no_telepon'),
        'lokasi' => Pelanggan::where('email', $request->email)->value('lokasi'),
    ];

    // Data customisasi
    $customization = $request->only(['material_id', 'frame_id', 'panjang', 'lebar', 'tinggi']);
    $material = Material::find($customization['material_id']);
    $frame = Material::find($customization['frame_id']);

    // Konstanta
    $sparePond = 10;
    $kupingan = 40;
    $panjangMaterial = 3000;
    $lebarMaterial = 2000;

    // Perhitungan body dan pintu
    $panjangBody = $customization['tinggi'] + $customization['lebar'] + $customization['tinggi'] + $sparePond;
    $lebarBody = ($panjangBody - 10) + $sparePond;
    $lembaranBody = ($panjangMaterial / $panjangBody) * ($lebarMaterial / $lebarBody);
    $hargaBody = $material->harga / $lembaranBody;

    $panjangPintu = $customization['tinggi'] + $kupingan + $sparePond;
    $lebarPintu = $kupingan + $customization['lebar'] + $kupingan + $sparePond;
    $lembaranPintu = ($panjangMaterial / $panjangPintu) * ($lebarMaterial / $lebarPintu);
    $hargaPintu = $material->harga / $lembaranPintu;

    // Harga box
    $hargaBox = $hargaBody + $hargaPintu;

    // Perhitungan frame
    $totalHargaFrame = (($frame->harga / ($panjangMaterial / $customization['panjang'])) * 2) +
                       (($frame->harga / ($lebarMaterial / $customization['lebar'])) * 2);

    // Komponen tambahan
    $cornerHarga = 1000; // Harga corner, bisa ambil dari tabel
    $handleHarga = 1850;
    $kanbanHarga = 3200;
    $screwHarga = 125;
    $mataItikHarga = 125;
    $printingHarga = 1500;

    $processHarga = 30000;
    $dieCutHarga = 5000;
    $transportHarga = 1000;

    $hargaTotalMaterial = $hargaBox + $totalHargaFrame + (4 * $cornerHarga) + (2 * $handleHarga) +
                          (2 * $kanbanHarga) + (16 * $screwHarga) + (16 * $mataItikHarga) +
                            $printingHarga;

    $hargaJasa = $processHarga + $dieCutHarga + $transportHarga;
    $profit = $hargaTotalMaterial * 0.3;

    $totalHargaProduksi = $hargaTotalMaterial + $hargaJasa + $profit;

    // Data untuk struk
    $strukData = [
        'customer' => $customer,
        'customization' => $customization,
        'total_harga' => $totalHargaProduksi,
    ];

    return view('struk', compact('strukData'));
}

}
