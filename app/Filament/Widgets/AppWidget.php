<?php

namespace App\Filament\Widgets;

use App\Models\Admin;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AppWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Marketing', Admin::count())
            ->description('Total marketing terdaftar')
            ->descriptionIcon('heroicon-m-user-group')
            ->color('success'),
            Stat::make('Marketing', Admin::count())
            ->description('Total marketing terdaftar')
            ->descriptionIcon('heroicon-m-user-group')
            ->color('success')
        ];
    }
}
