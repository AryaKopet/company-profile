<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\MaterialStats;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard Super Admin';
    protected static string $view = 'filament.pages.dashboard';
    protected function getWidgets(): array
    {
        return [
            MaterialStats::class,
        ];
    }

}
