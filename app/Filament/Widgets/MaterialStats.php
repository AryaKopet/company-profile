<?php

namespace App\Filament\Widgets;

use App\Models\Material;
use Filament\Widgets\Widget;

class MaterialStats extends Widget
{
    protected static string $view = 'filament.widgets.material-stats';

    // Menghitung jumlah material yang ada di database
    public function getMaterialCount(): int
    {
        return Material::count();
    }
}
