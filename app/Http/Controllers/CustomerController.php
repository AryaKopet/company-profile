<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Pelanggan; // Pastikan Anda menggunakan model Pelanggan

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

        // Simpan data ke tabel pelanggan
        Pelanggan::create([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'no_telepon' => $validated['phone'],
            'lokasi' => $validated['location'],
        ]);

        // Menyimpan session flash untuk menampilkan notifikasi sukses
        session()->flash('success', 'Data berhasil ditambahkan!');

        // Redirect ke step 2
        return redirect()->route('customize.box.step2');
    }

    // Menampilkan Step 2
    public function showStep2()
    {
        // Ambil data material dan frame dari tabel 'materials'
        $materials = Material::where('type', 'material')->get();
        $frames = Material::where('type', 'frame')->get();

        return view('customize-box-step2', compact('materials', 'frames'));
    }

    // Menangani form Step 2
    public function submitStep2(Request $request)
    {
        // Validasi data dari step 2
        $validated = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'frame_id' => 'required|exists:materials,id',
            'length' => 'required|numeric|min:1',
            'width' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
        ]);

        // Ambil data dari session
        $step1Data = session('step1');

        // Simpan atau proses data lebih lanjut sesuai kebutuhan
        
        // Contoh return ke hasil perhitungan
        return view('result-box', compact('step1Data', 'validated'));
    }
}
