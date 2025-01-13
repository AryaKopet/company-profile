<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan; // Pastikan model sesuai
use App\Models\Material; // Model untuk tabel material

class PesananController extends Controller
{
    public function calculate(Request $request)
    {
        // Ambil data inputan
        $inputPanjang = $request->panjang;
        $inputLebar = $request->lebar;
        $inputTinggi = $request->tinggi;
        $materialId = $request->material_id;
        $frameId = $request->frame_id;

        // Data fix dari perusahaan
        $panjangMaterial = 3000; // mm
        $lebarMaterial = 2000; // mm
        $sparePond = 10; // mm
        $kupingan = 40; // mm

        // Ambil data material dan frame
        $material = Material::find($materialId);
        $frame = Material::find($frameId);

        // Step 1: Hitung body
        $panjangBody = $inputTinggi + $inputLebar + $inputTinggi + $sparePond;
        $lebarBody = ($panjangBody - 10) + $sparePond;

        // Step 2: Hitung pintu
        $panjangPintu = $inputTinggi + $kupingan + $sparePond;
        $lebarPintu = $kupingan + $inputLebar + $kupingan + $sparePond;

        // Step 3: Hitung lembaran body
        $panjangLembaranBody = $panjangMaterial / $panjangBody;
        $lebarLembaranBody = $lebarMaterial / $lebarBody;
        $lembaranBody = $panjangLembaranBody * $lebarLembaranBody;

        // Step 4: Hitung lembaran pintu
        $panjangLembaranPintu = $panjangMaterial / $panjangPintu;
        $lebarLembaranPintu = $lebarMaterial / $lebarPintu;
        $lembaranPintu = $panjangLembaranPintu * $lebarLembaranPintu;

        // Step 5: Harga material
        $hargaBody = $material->harga / $lembaranBody;
        $hargaPintu = $material->harga / $lembaranPintu;
        $hargaBox = $hargaBody + $hargaPintu;

        // Tahap 2: Hitung harga frame
        $panjangFrame = $panjangMaterial / $inputPanjang;
        $totalPanjangFrame = $frame->harga / $panjangFrame;

        $lebarFrame = $lebarMaterial / $inputLebar;
        $totalLebarFrame = $frame->harga / $lebarFrame;

        $totalHargaFrame = ($totalPanjangFrame * 2) + ($totalLebarFrame * 2);

        // Tahap 3: Hitung biaya total
        $hargaTotalMaterial = $hargaBox + $totalHargaFrame;

        // Biaya tambahan
        $hargaProcess = $material->harga_process ?? 0;
        $hargaDieCut = $material->harga_die_cut ?? 0;
        $hargaTransport = $material->harga_transport ?? 0;
        $profit = $hargaTotalMaterial * 0.3;

        // Total harga produksi
        $totalHargaProduksi = $hargaTotalMaterial + $hargaProcess + $hargaDieCut + $hargaTransport + $profit;

        // Return hasil
        return response()->json([
            'harga_box' => $hargaBox,
            'harga_frame' => $totalHargaFrame,
            'total_harga_produksi' => $totalHargaProduksi,
        ]);
    }
}
