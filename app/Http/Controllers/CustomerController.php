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
        // Validasi input dengan custom message
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'phone' => 'required|string|max:20',
            'location' => 'required|in:jabodetabek,luar',
        ], [
            'email.unique' => 'Email sudah digunakan, harap coba lagi.',
            'email.required' => 'Email wajib diisi.',
            'name.required' => 'Nama wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'location.required' => 'Lokasi wajib dipilih.',
        ]);
        

        // Simpan data pelanggan ke database
        $pelanggan = Pelanggan::create([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'no_telepon' => $validated['phone'],
            'lokasi' => $validated['location'],
        ]);

        // Simpan email ke session
        $request->session()->put('email', $request->email);

        // Redirect ke Step 2
        return redirect()->route('customize.box.step2');
    }



    // Menampilkan Step 2
    public function showStep2(Request $request)
    {
        $materials = Material::where('kategori', 'Material')->get();
        $frames = Material::where('kategori', 'Frame')->get();
        $email = $request->session()->get('email');

        return view('customize-box-step2', compact('email','materials', 'frames'));
    }

    // Menangani form Step 2
    public function submitStep2(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:pelanggan,email', // Pastikan email terdaftar di tabel pelanggan
            'bahan_material' => 'required|string',
            'frame' => 'required|string',
            'panjang' => 'required|integer',
            'lebar' => 'required|integer',
            'tinggi' => 'required|integer'
        ]);

        // Simpan data pesanan ke tabel pesanan
        Pesanan::create([
            'email' => $request->email,
            'bahan_material' => Material::find($validated['material_id'])->barang,
            'frame' => Material::find($validated['frame_id'])->barang,
            'panjang' => $validated['panjang'],
            'lebar' => $validated['lebar'],
            'tinggi' => $validated['tinggi'],
        ]);

        return redirect()->route('landing-page')->with('success', 'Pesanan berhasil disimpan!');
    }

}
