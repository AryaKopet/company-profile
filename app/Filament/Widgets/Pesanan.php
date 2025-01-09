<?php

namespace App\Filament\Widgets;

use App\Models\Pesanan as ModelsPesanan;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Pesanan extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pesanan', ModelsPesanan::count())
            ->description('Pesanan Terverifikasi')
            ->descriptionIcon('heroicon-m-shopping-bag', IconPosition::Before)
            ->color('success')
            ->chart([1,3,5,10,20,40])
        ];
    }
}
