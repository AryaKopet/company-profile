<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Pelanggan;
use Barryvdh\DomPDF\Facade\Pdf;

class PesananController extends Controller
{
    public function generateStruk(Request $request)
    {
        // Ambil data pelanggan
        $pelanggan = Pelanggan::where('email', $request->email)->first();
        if (!$pelanggan) {
            return back()->withErrors(['error' => 'Pelanggan tidak ditemukan.']);
        }

        $customer = [
            'nama' => $pelanggan->nama,
            'email' => $pelanggan->email,
            'no_telepon' => $pelanggan->no_telepon,
            'lokasi' => $pelanggan->lokasi,
        ];

        // Ambil data customisasi
        $customization = $request->only(['material_id', 'frame', 'panjang', 'lebar', 'tinggi']);
        $material = Material::find($customization['material_id']);
        $frame = Material::find($customization['frame']);

        if (!$material || !$frame) {
            return back()->withErrors(['error' => 'Material atau frame tidak ditemukan.']);
        }

        $customization['material_name'] = $material->barang ?? 'Material tidak ditemukan';
        $customization['frame_name'] = $frame->barang ?? 'Frame tidak ditemukan';

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
        $hargaFrame = ($totalPanjangFrame + $totalLebarFrame) * $frame->harga / $panjangMaterial;

        // Harga komponen tambahan
        $components = [
            'corner' => Material::where('barang', 'corner')->value('harga'),
            'handle' => Material::where('barang', 'handle')->value('harga'),
            'kanban' => Material::where('barang', 'kanban')->value('harga'),
            'screw' => Material::where('barang', 'screw')->value('harga'),
            'mata_itik' => Material::where('barang', 'mata itik')->value('harga'),
            'printing' => Material::where('barang', 'printing')->value('harga'),
            'process' => Material::where('barang', 'process')->value('harga'),
            'die_cut' => Material::where('barang', 'die cut')->value('harga'),
            'transport' => Material::where('barang', 'transport jabodetabek')->value('harga'),
        ];

        // Total harga material
        $hargaTotalMaterial = $hargaBox + $hargaFrame + 
                              (4 * $components['corner']) + (2 * $components['handle']) +
                              (2 * $components['kanban']) + (16 * $components['screw']) +
                              (16 * $components['mata_itik']) + $components['printing'];

        // Harga jasa
        $hargaJasa = $components['process'] + $components['die_cut'] + $components['transport'];
        $profit = $hargaTotalMaterial * 0.3;
        $hargaTotalJasa = $hargaJasa + $profit;

        // Total harga produksi
        $totalHargaProduksi = $hargaTotalMaterial + $hargaTotalJasa;

        // Data untuk struk
        $strukData = [
            'customer' => $customer,
            'customization' => $customization,
            'total_harga' => round($totalHargaProduksi, 0),
        ];

        return view('struk', compact('strukData'));
    }

    public function cetakStruk($id)
    {
        $customer = Pelanggan::where('email', $id)->first();
        if (!$customer) {
            return back()->withErrors(['error' => 'Data pelanggan tidak ditemukan.']);
        }

        $strukData = [
            'customer' => [
                'nama' => $customer->nama,
                'email' => $customer->email,
                'no_telepon' => $customer->no_telepon,
                'lokasi' => $customer->lokasi,
            ],
            'customization' => [
                'material_name' => 'N/A',
                'frame_name' => 'N/A',
                'panjang' => 'N/A',
                'lebar' => 'N/A',
                'tinggi' => 'N/A',
            ],
            'total_harga' => 0,
        ];

        $pdf = PDF::loadView('struk', compact('strukData'));
        return $pdf->download('struk_pemesanan.pdf');
    }
}
