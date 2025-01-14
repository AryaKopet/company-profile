<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struk extends Model
{
    use HasFactory;

    protected $table = 'struk'; // Nama tabel

    protected $fillable = [
        'nama_pelanggan',
        'email',
        'no_telepon',
        'lokasi',
        'material_name',
        'frame_name',
        'panjang',
        'lebar',
        'tinggi',
        'total_harga',
    ];
}
