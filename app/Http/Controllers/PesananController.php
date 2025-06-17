<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Barryvdh\DomPDF\Facade\Pdf;

class PesananController extends Controller
{
    private function generateNomorStruk($id_pesanan)
    {
        $romawiBulan = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'];
        $bulan = $romawiBulan[date('n')]; // Bulan sekarang dalam format Romawi
        $tahun = date('Y'); // Tahun sekarang

        return sprintf('%03d/PT-SHI/%s/%d', $id_pesanan, $bulan, $tahun);
    }

    public function generateStruk(Request $request)
    {
        // Ambil pesanan terbaru berdasarkan email
        $pesanan = Pesanan::where('email', $request->email)->latest()->first();
        if (!$pesanan) {
            return back()->withErrors(['error' => 'Pesanan tidak ditemukan.']);
        }

        // Ambil data pelanggan berdasarkan email yang sama persis dengan pesanan
        $pelanggan = Pelanggan::where('email', $pesanan->email)->latest()->first();
        if (!$pelanggan) {
            return back()->withErrors(['error' => 'Pelanggan tidak ditemukan.']);
        }

        $customer = [
            'nama' => $pelanggan->nama,
            'email' => $pelanggan->email,
            'no_telepon' => $pelanggan->no_telepon,
            'lokasi' => $pelanggan->lokasi,
        ];

        // Ambil data customisasi dari request
        $customization = $request->only(['material_id', 'nama_box', 'frame', 'panjang', 'lebar', 'tinggi']);
        $material = Material::find($customization['material_id']);
        $frame = Material::find($customization['frame']);

        if (!$material || !$frame) {
            return back()->withErrors(['error' => 'Material atau frame tidak ditemukan.']);
        }

        $customization['material_name'] = $material->barang ?? 'Material tidak ditemukan';
        $customization['frame_name'] = $frame->barang ?? 'Frame tidak ditemukan';

        // Generate nomor struk
        $nomorStruk = $this->generateNomorStruk($pesanan->id_pesanan);

        // Data untuk struk
        $strukData = [
            'customer' => $customer,
            'customization' => $customization,
            'total_harga' => round($request['total_harga'], 0),
            'nomor_struk' => $nomorStruk,
        ];

        return view('struk', compact('strukData'));
    }


    public function cetakStruk($id)
    {
        $customer = Pelanggan::where('email', $id)->first();
        if (!$customer) {
            return back()->withErrors(['error' => 'Data pelanggan tidak ditemukan.']);
        }

        // Ambil data pesanan yang sesuai dengan email pelanggan
        $pesanan = Pesanan::where('email', $id)->latest()->first();
        if (!$pesanan) {
            return back()->withErrors(['error' => 'Pesanan tidak ditemukan.']);
        }

        // Generate nomor struk
        $nomorStruk = $this->generateNomorStruk($pesanan->id_pesanan);

        // Data untuk struk
        $strukData = [
            'customer' => [
                'nama' => $customer->nama,
                'email' => $customer->email,
                'no_telepon' => $customer->no_telepon,
                'lokasi' => $pesanan->lokasi,
            ],
            'customization' => [
                'nama_box' => $pesanan->nama_box,
                'material_name' => $pesanan->bahan_material,
                'frame_name' => $pesanan->frame,
                'panjang' => $pesanan->panjang,
                'lebar' => $pesanan->lebar,
                'tinggi' => $pesanan->tinggi,
            ],
            'total_harga' => $pesanan->harga,
            'nomor_struk' => $nomorStruk,
        ];

        // Generate PDF
        $pdf = Pdf::loadView('struk-pdf', compact('strukData'));
        return $pdf->download('surat_penawaran.pdf');
    }

    // Fungsi untuk admin bisa mencetak struk pesanan pelanggan dari dashboard filament
    public function adminCetakStruk($id)
    {
        $pesanan = Pesanan::where('id_pesanan', $id)->first();
        if (!$pesanan) {
            abort(404, 'Pesanan tidak ditemukan.');
        }

        $pelanggan = Pelanggan::where('email', $pesanan->email)->latest()->first();
        if (!$pelanggan) {
            abort(404, 'Pelanggan tidak ditemukan.');
        }

        $nomorStruk = $this->generateNomorStruk($pesanan->id_pesanan);

        $strukData = [
            'customer' => [
                'nama' => $pelanggan->nama,
                'email' => $pelanggan->email,
                'no_telepon' => $pelanggan->no_telepon,
                'lokasi' => $pelanggan->lokasi,
            ],
            'customization' => [
                'nama_box' => $pesanan->nama_box,
                'material_name' => $pesanan->bahan_material,
                'frame_name' => $pesanan->frame,
                'panjang' => $pesanan->panjang,
                'lebar' => $pesanan->lebar,
                'tinggi' => $pesanan->tinggi,
            ],
            'total_harga' => $pesanan->harga,
            'nomor_struk' => $nomorStruk,
        ];

        $pdf = Pdf::loadView('struk-pdf', compact('strukData'));
        return $pdf->download("struk-{$id}.pdf");
    }
}
