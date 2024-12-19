<?php

namespace App\Filament\Widgets;

use App\Models\Material;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class MaterialStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Material', Material::count())
                ->description('Material Tersedia')
                ->icon('heroicon-o-cube')
                ->color('primary'),
        ];
    }
}
