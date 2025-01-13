<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class PesananController extends Controller
{
    public function generateStruk(Request $request)
    {
        // Data pelanggan dari Form 1
        $customer = [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'lokasi' => $request->lokasi,
        ];

        // Data customisasi dari Form 2
        $customization = [
            'material_id' => $request->material_id,
            'frame_id' => $request->frame_id,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'tinggi' => $request->tinggi,
        ];

        // Ambil data material dan frame
        $material = Material::find($customization['material_id']);
        $frame = Material::find($customization['frame_id']);

        // Rumus perhitungan harga
        $sparePond = 10;
        $kupingan = 40;
        $panjangMaterial = 3000;
        $lebarMaterial = 2000;

        // Perhitungan body
        $panjangBody = $customization['tinggi'] + $customization['lebar'] + $customization['tinggi'] + $sparePond;
        $lebarBody = ($panjangBody - 10) + $sparePond;
        $lembaranBody = ($panjangMaterial / $panjangBody) * ($lebarMaterial / $lebarBody);
        $hargaBody = $material->harga / $lembaranBody;

        // Perhitungan pintu
        $panjangPintu = $customization['tinggi'] + $kupingan + $sparePond;
        $lebarPintu = $kupingan + $customization['lebar'] + $kupingan + $sparePond;
        $lembaranPintu = ($panjangMaterial / $panjangPintu) * ($lebarMaterial / $lebarPintu);
        $hargaPintu = $material->harga / $lembaranPintu;

        // Harga total material dan frame
        $hargaBox = $hargaBody + $hargaPintu;
        $totalHargaFrame = ($frame->harga / ($panjangMaterial / $customization['panjang'])) * 2 +
                           ($frame->harga / ($lebarMaterial / $customization['lebar'])) * 2;

        // Total harga akhir
        $hargaTotal = $hargaBox + $totalHargaFrame;

        // Data untuk struk
        $strukData = [
            'customer' => $customer,
            'customization' => $customization,
            'total_harga' => $hargaTotal,
        ];

        // Arahkan ke halaman struk dengan data
        return view('struk', compact('strukData'));
    }
}
