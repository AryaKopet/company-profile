<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Pelanggan;
use App\Models\Pesanan;

class CustomerController extends Controller
{
    public function showStep1()
    {
        return view('customize-box-step1');
    }

    public function submitStep1(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'location' => 'required|in:jabodetabek,luar',
            'provinsi' => 'required_if:location,luar',
            'kota' => 'required_if:location,luar',
            'alamat' => 'required_if:location,luar',
        ]);

        $lokasi = $validated['location'] === 'luar'
            ? $request->input('provinsi') . ', ' . $request->input('kota') . ', ' . $request->input('alamat')
            : $validated['location'];

        Pelanggan::create([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'no_telepon' => $validated['phone'],
            'lokasi' => $lokasi,
        ]);

        $request->session()->put('email', $validated['email']);
        $request->session()->put('lokasi', $lokasi);

        return redirect()->route('customize.box.step2');
    }

    public function showStep2(Request $request)
    {
        $materials = Material::where('kategori', 'Material')->get();
        $frames = Material::where('kategori', 'Frame')->get();
        $email = $request->session()->get('email');

        if (!$email) {
            return redirect()->route('customize.box.step1')->withErrors('Silakan lengkapi Step 1 terlebih dahulu.');
        }

        return view('customize-box-step2', compact('email', 'materials', 'frames'));
    }

    public function submitStep2(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:pelanggan,email',
            'nama_box' => 'required|string|max:255',
            'material_id' => 'required|exists:materials,id_material',
            'frame' => 'required|exists:materials,id_material',
            'panjang' => 'required|integer|min:1',
            'lebar' => 'required|integer|min:1',
            'tinggi' => 'required|integer|min:1',
        ]);

        $material = Material::find($validated['material_id']);
        $frame = Material::find($validated['frame']);

        $sparePond = 10;
        $kupingan = 40;
        $panjangMaterial = 3000;
        $lebarMaterial = 2000;

        $customRound = function ($value) {
            return ($value - floor($value) >= 0.5) ? ceil($value) : floor($value);
        };

        $panjangBody = $validated['tinggi'] + $validated['lebar'] + $validated['tinggi'] + $sparePond;
        $lebarBody = ($panjangBody - 10) + $sparePond;
        $lembaranBody = ($panjangMaterial / $panjangBody) * ($lebarMaterial / $lebarBody);
        $hargaBody = $material->harga / $customRound($lembaranBody);

        $panjangPintu = $validated['tinggi'] + $kupingan + $sparePond;
        $lebarPintu = $kupingan + $validated['lebar'] + $kupingan + $sparePond;
        $lembaranPintu = ($panjangMaterial / $panjangPintu) * ($lebarMaterial / $lebarPintu);
        $hargaPintu = $material->harga / $customRound($lembaranPintu);

        $hargaBox = $hargaBody + $hargaPintu;

        $totalPanjangFrame = $validated['panjang'] * 2;
        $totalLebarFrame = $validated['lebar'] * 2;
        $hargaFrame = ($totalPanjangFrame + $totalLebarFrame) * $frame->harga / $panjangMaterial;

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

        $hargaTotalMaterial = $hargaBox + $hargaFrame +
            (4 * $components['corner']) + (2 * $components['handle']) +
            (2 * $components['kanban']) + (16 * $components['screw']) +
            (16 * $components['mata_itik']) + $components['printing'];

        $hargaJasa = $components['process'] + $components['die_cut'] + $components['transport'];
        $profit = $hargaTotalMaterial * 0.3;
        $totalHargaProduksi = $hargaTotalMaterial + $hargaJasa + $profit;

        // Ambil lokasi dari session
        $lokasi = $request->session()->get('lokasi') ?? '-';

        // ✅ Simpan ke tabel pesanan lengkap dengan lokasi
        $pesanan = Pesanan::create([
            'email' => $validated['email'],
            'nama_box' => $validated['nama_box'],
            'bahan_material' => $material->barang,
            'frame' => $frame->barang,
            'panjang' => $validated['panjang'],
            'lebar' => $validated['lebar'],
            'tinggi' => $validated['tinggi'],
            'harga' => round($totalHargaProduksi, 2),
            'lokasi' => $lokasi, // ✅ tambahkan lokasi ke pesanan
        ]);

        $validated['id_pesanan'] = $pesanan->id_pesanan;
        $validated['total_harga'] = $pesanan->harga;
        return redirect()->route('generate.struk', $validated);
    }
}
