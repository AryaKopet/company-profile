<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Filament\Panel;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::serving(function () {
        });
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->brandLogo(asset('assets/logo.png'));
    }
}
