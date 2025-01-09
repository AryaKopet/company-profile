<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Log;
use App\Filament\Widgets\MaterialStats;
use App\Filament\Widgets\AdminStats;
use App\Filament\Widgets\PelangganWidget;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static string $view = 'filament.pages.dashboard';

    protected function getColumns(): int
    {
        return 3;
    }
}
