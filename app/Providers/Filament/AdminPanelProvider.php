<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\AppWidget;
use App\Filament\Widgets\Pesanan;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\MenuItem;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class AdminPanelProvider extends PanelProvider
{   
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->profile(isSimple: false)
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => color::Blue,
                // 'danger' => Color::Rose,
                // 'gray' => Color::Gray,
                // 'info' => Color::Blue,
                // 'primary' => Color::Indigo,
                // 'success' => Color::Emerald,
                // 'warning' => Color::Orange,
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                ->label(fn() => auth()->user()->name)
                ->icon('heroicon-m-user-circle')
                //If you are using tenancy need to check with the visible method where ->company() is the relation between the user and tenancy model as you called
            ])
            ->favicon(asset('assets/logo.png'))
            // ->brandLogo(asset('assets/logo.png'))
            // ->brandLogoHeight('65px')
            ->brandName('PT Sugi Harti Indonesia')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AppWidget::class,
                Pesanan::class
            ])
            ->navigationGroups([
                'Data Master',
                'Shop',
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css');
            // ->plugins([
            //     FilamentEditProfilePlugin::make()
            // ]);
    }
}
