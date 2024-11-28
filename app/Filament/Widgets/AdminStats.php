<?php

namespace App\Filament\Widgets;

use App\Models\Admin;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class AdminStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Admins', Admin::count())
                ->description('Admin Terdaftar')
                ->icon('heroicon-o-user')
                ->color('success'), 
        ];
    }
}
