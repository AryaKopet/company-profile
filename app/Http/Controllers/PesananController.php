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

        // Fungsi pembulatan khusus
        $customRound = function ($value) {
            return ($value - floor($value) >= 0.5) ? ceil($value) : floor($value);
        };

        // Perhitungan body dan pintu
        $panjangBody = $customization['tinggi'] + $customization['lebar'] + $customization['tinggi'] + $sparePond;
        $lebarBody = ($panjangBody - 10) + $sparePond;

        $panjangPintu = $customization['tinggi'] + $kupingan + $sparePond;
        $lebarPintu = $kupingan + $customization['lebar'] + $kupingan + $sparePond;

        $lembaranBody = ($panjangMaterial / $panjangBody) * ($lebarMaterial / $lebarBody);
        $hargaBody = $material->harga / $customRound($lembaranBody);

        $lembaranPintu = ($panjangMaterial / $panjangPintu) * ($lebarMaterial / $lebarPintu);
        $hargaPintu = $material->harga / $customRound($lembaranPintu);

        $hargaBox = $hargaBody + $hargaPintu;

        // Perhitungan frame
        $totalPanjangFrame = $customization['panjang'] * 2;
        $totalLebarFrame = $customization['lebar'] * 2;
        $HargaFrame = ($totalPanjangFrame + $totalLebarFrame) * $frame->harga / $panjangMaterial;

        // Ambil harga komponen tambahan dari database
        $cornerHarga = Material::where('barang', 'corner')->value('harga');
        $handleHarga = Material::where('barang', 'handle')->value('harga');
        $kanbanHarga = Material::where('barang', 'kanban')->value('harga');
        $screwHarga = Material::where('barang', 'screw')->value('harga');
        $mataItikHarga = Material::where('barang', 'mata itik')->value('harga');
        $printingHarga = Material::where('barang', 'printing')->value('harga');
        $processHarga = Material::where('barang', 'process')->value('harga');
        $dieCutHarga = Material::where('barang', 'die cut')->value('harga');
        $transportHarga = Material::where('barang', 'transport jabodetabek')->value('harga');

        // Total harga material
        $hargaTotalMaterial = $hargaBox + $HargaFrame + 
                              (4 * $cornerHarga) + (2 * $handleHarga) +
                              (2 * $kanbanHarga) + (16 * $screwHarga) +
                              (16 * $mataItikHarga) + $printingHarga;

        // Harga jasa
        $hargaJasa = $processHarga + $dieCutHarga + $transportHarga;
        $profit = $hargaTotalMaterial * 0.3;
        $hargaTotalJasa = $hargaJasa + $profit;

        // Total harga produksi
        $totalHargaProduksi = $hargaTotalMaterial + $hargaTotalJasa;

        // Data untuk struk
        $strukData = [
            'customer' => $customer,
            'customization' => $customization,
            'total_harga' => round($totalHargaProduksi, 0), // Pembulatan akhir
        ];

        return view('struk', compact('strukData'));
    }
}
