<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Pelanggan;

class PesananController extends Controller
{
    public function generateStruk(Request $request)
    {
        // Data pelanggan dari request
        $customer = [
            'nama' => Pelanggan::where('email', $request->email)->value('nama'),
            'email' => $request->email,
            'no_telepon' => Pelanggan::where('email', $request->email)->value('no_telepon'),
            'lokasi' => Pelanggan::where('email', $request->email)->value('lokasi'),
        ];

        // Data customisasi dari request
        $customization = $request->only(['material_id', 'frame_id', 'panjang', 'lebar', 'tinggi']);

        // Ambil data material dan frame
        $material = Material::find($customization['material_id']);
        $frame = Material::find($customization['frame_id']);

        // Perhitungan harga
        $sparePond = 10;
        $kupingan = 40;
        $panjangMaterial = 3000;
        $lebarMaterial = 2000;

        $panjangBody = $customization['tinggi'] + $customization['lebar'] + $customization['tinggi'] + $sparePond;
        $lebarBody = ($panjangBody - 10) + $sparePond;
        $lembaranBody = ($panjangMaterial / $panjangBody) * ($lebarMaterial / $lebarBody);
        $hargaBody = $material->harga / $lembaranBody;

        $panjangPintu = $customization['tinggi'] + $kupingan + $sparePond;
        $lebarPintu = $kupingan + $customization['lebar'] + $kupingan + $sparePond;
        $lembaranPintu = ($panjangMaterial / $panjangPintu) * ($lebarMaterial / $lebarPintu);
        $hargaPintu = $material->harga / $lembaranPintu;

        $hargaBox = $hargaBody + $hargaPintu;
        $totalHargaFrame = ($frame->harga / ($panjangMaterial / $customization['panjang'])) * 2 +
                           ($frame->harga / ($lebarMaterial / $customization['lebar'])) * 2;

        $totalHarga = $hargaBox + $totalHargaFrame;

        // Data untuk struk
        $strukData = [
            'customer' => $customer,
            'customization' => $customization,
            'total_harga' => $totalHarga,
        ];

        return view('struk', compact('strukData'));
    }
}
