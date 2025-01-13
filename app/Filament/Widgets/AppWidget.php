<?php

namespace App\Filament\Widgets;

use App\Models\Admin;
use App\Models\Material;
use App\Models\Pelanggan;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AppWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Material', Material::count())
            ->description('Material tersedia')
            ->descriptionIcon('heroicon-o-folder', IconPosition::Before)
            ->color('primary'),
            Stat::make('Marketing', Admin::count())
            ->description('Marketing terdaftar')
            ->descriptionIcon('heroicon-m-user-group',IconPosition::Before)
            ->color('primary'),
            Stat::make('Calon Pelanggan', Pelanggan::count())
            ->description('Calon pelanggan')
            ->descriptionIcon('heroicon-o-users',IconPosition::Before)
            ->color('primary')
        ];
    }
}
 