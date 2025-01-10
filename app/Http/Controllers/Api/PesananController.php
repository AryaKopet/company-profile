<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\PesananResource;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $pesanans = Pesanan::orderBy('id_pesanan', 'asc')->paginate(5);
        return new PesananResource(true, 'List Data Pesanan', $pesanans);
    }

    public function show($id)
    {
        $pesanans = Pesanan::find($id);
        return new PesananResource(true, 'Detail Data Materials', $pesanans);
    }
}
