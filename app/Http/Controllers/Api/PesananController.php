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
        //get all posts
        $pesanans = Pesanan::latest()->paginate(5);

        //return collection of posts as a resource
        return new PesananResource(true, 'List Data Pesanan', $pesanans);
    }
}
