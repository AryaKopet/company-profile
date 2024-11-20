<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'aryasokker23@gmail.com', // Ubah email ini sesuai keinginan Anda
            'password' => Hash::make('arya2003ok'), // Ganti dengan password yang diinginkan
        ]);
    }
}
