<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan'; // Nama tabel

    protected $primaryKey = 'id_pesanan'; // Primary key

    protected $fillable = [
        'email',
        'nama_box',
        'bahan_material',
        'frame',
        'panjang',
        'lebar',
        'tinggi',
        'harga'
    ];
}
