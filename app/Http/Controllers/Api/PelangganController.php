<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PelangganResource;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
        /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $pelanggans = Pelanggan::orderBy('id_material', 'asc')->paginate(5);
        return new PelangganResource(true, 'List Data Pelanggan', $pelanggans);
    }
    
    public function show($id)
    {
        $pelanggans = Pelanggan::find($id);
        return new PelangganResource(true, 'Detail Data Pelanggan', $pelanggans);
    }
}
