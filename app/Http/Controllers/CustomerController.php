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
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'phone' => 'required|string|max:20',
            'location' => 'required|in:jabodetabek,luar',
        ]);

        // Simpan data pelanggan
        Pelanggan::create([
            'nama' => $validated['name'],
            'email' => $validated['email'],
            'no_telepon' => $validated['phone'],
            'lokasi' => $validated['location'],
        ]);

        // Simpan email ke session
        $request->session()->put('email', $validated['email']);

        return redirect()->route('customize.box.step2');
    }

    // Menampilkan Step 2
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

    // Menangani form Step 2
    public function submitStep2(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|email|exists:pelanggan,email',
            'material_id' => 'required|exists:materials,id_material',
            'frame' => 'required|exists:materials,id_material',
            'panjang' => 'required|integer|min:1',
            'lebar' => 'required|integer|min:1',
            'tinggi' => 'required|integer|min:1',
        ]);

        // Simpan data pesanan
        Pesanan::create([
            'email' => $validated['email'],
            'bahan_material' => Material::find($validated['material_id'])->barang,
            'frame' => Material::find($validated['frame'])->barang,
            'panjang' => $validated['panjang'],
            'lebar' => $validated['lebar'],
            'tinggi' => $validated['tinggi'],
        ]);

        // Redirect ke PesananController untuk menghitung dan menampilkan struk
        return redirect()->route('generate.struk', [
            'email' => $validated['email'],
            'material_id' => $validated['material_id'],
            'frame_id' => $validated['frame'],
            'panjang' => $validated['panjang'],
            'lebar' => $validated['lebar'],
            'tinggi' => $validated['tinggi'],
        ]);
    }
}
