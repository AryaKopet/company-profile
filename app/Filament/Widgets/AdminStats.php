<?php

namespace App\Filament\Widgets;

use App\Models\Admin;
use Filament\Widgets\Widget;

class Adminstats extends Widget
{
    protected static string $view = 'filament.widgets.admin-stats';

    // Menghitung jumlah material yang ada di database
    public function getAdminCount(): int
    {
        return Admin::count();
    }
    public function getIcon(): string
    {
        return 'heroicon-o-user'; // Nama ikon dari Heroicons
    }
}
