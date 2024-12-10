<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Pelanggan;
use App\Models\Pesanan;

class CustomerController extends Controller
{
    // Menampilkan Step 1
    public function showStep1()
    {
        return view('customize-box-step1');
    }

    // Menangani form Step 1
    public function submitStep1(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'location' => 'required|in:jabodetabek,luar',
        ]);

        $pelanggan = Pelanggan::create([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'no_telepon' => $validated['phone'],
            'lokasi' => $validated['location'],
        ]);

        session(['pelanggan_id' => $pelanggan->id]);

        return redirect()->route('customize.box.step2');
    }

    // Menampilkan Step 2
    public function showStep2()
    {
        $materials = Material::where('kategori', 'Material')->get();
        $frames = Material::where('kategori', 'Frame')->get();

        return view('customize-box-step2', compact('materials', 'frames'));
    }

    // Menangani form Step 2
    public function submitStep2(Request $request)
    {
        // Log request data untuk memastikan data terkirim

        // Validasi input dari form Step 2
        $validated = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'frame_id' => 'required|exists:materials,id',
            'length' => 'required|numeric|min:1',
            'width' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
        ]);

        // Ambil ID pelanggan dari session
        $pelangganId = session('pelanggan_id');
        if (!$pelangganId) {
            return redirect()->route('customize.box.step1')->with('error', 'Data pelanggan tidak ditemukan. Silakan isi Step 1 terlebih dahulu.');
        }

        // Simpan data ke tabel pesanan
        $pesanan = Pesanan::create([
            'id_pelanggan' => $pelangganId,
            'bahan_material' => Material::find($validated['material_id'])->nama,
            'frame' => Material::find($validated['frame_id'])->nama,
            'panjang' => $validated['length'],
            'lebar' => $validated['width'],
            'tinggi' => $validated['height'],
        ]);

        // Jika data berhasil disimpan
        if ($pesanan) {
            session()->forget('pelanggan_id');
            return redirect('/')->with('success', 'Pesanan berhasil disimpan!');
        }

        return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }


}
