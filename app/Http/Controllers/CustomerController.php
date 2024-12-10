<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Pelanggan;
use App\Models\Pesanan; // Tambahkan model Pesanan

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
        // Validasi data yang diinputkan
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'location' => 'required|in:jabodetabek,luar',
        ]);

        // Simpan data pelanggan ke database
        $pelanggan = Pelanggan::create([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'no_telepon' => $validated['phone'],
            'lokasi' => $validated['location'],
        ]);

        // Simpan data pelanggan di session untuk digunakan di Step 2
        session(['pelanggan_id' => $pelanggan->id]);

        // Redirect ke Step 2
        return redirect()->route('customize.box.step2');
    }

    // Menampilkan Step 2
    public function showStep2()
    {
        // Ambil data material yang kategorinya 'Material'
        $materials = Material::where('kategori', 'Material')->get();

        // Ambil data frame yang kategorinya 'Frame'
        $frames = Material::where('kategori', 'Frame')->get();

        return view('customize-box-step2', compact('materials', 'frames'));
    }

    // Menangani form Step 2
    public function submitStep2(Request $request)
    {
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
        Pesanan::create([
            'id_pelanggan' => $pelangganId,
            'bahan_material' => Material::find($validated['material_id'])->nama,
            'frame' => Material::find($validated['frame_id'])->nama,
            'panjang' => $validated['length'],
            'lebar' => $validated['width'],
            'tinggi' => $validated['height'],
        ]);

        // Hapus session pelanggan
        session()->forget('pelanggan_id');

        // Redirect ke halaman utama dengan notifikasi sukses
        return redirect('/')->with('success', 'Pesanan berhasil disimpan!');
    }
}
