<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pelanggan';
    protected $table = 'pelanggan';
    protected $fillable = ['nama', 'email', 'no_telepon', 'lokasi'];

    // Relasi ke Pesanan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_pelanggan', 'id');
    }
}

