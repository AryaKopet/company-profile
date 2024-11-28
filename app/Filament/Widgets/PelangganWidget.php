<?php

namespace App\Filament\Widgets;

use App\Models\Pelanggan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class PelangganWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Pelanggan', Pelanggan::count())
                ->description('Pelanggan terdaftar')
                ->icon('heroicon-o-users')
                ->color('success'),
        ];
    }
}
