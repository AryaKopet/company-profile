<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Mengganti Nama Aplikasi di Filament
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'PT. Sugi Harti Indonesia', // Ganti dengan nama aplikasi yang diinginkan
            ]);
        });
    }
}
