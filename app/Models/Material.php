<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    // Tentukan primary key baru
    protected $primaryKey = 'id_material';

    // Jika bukan incrementing (bila tidak menggunakan integer/auto increment)
    public $incrementing = true;

    // Jika primary key bukan integer, tambahkan tipe datanya
    protected $keyType = 'int';

    protected $fillable = [
        'barang',
        'kategori',
        'harga',
    ];
}
