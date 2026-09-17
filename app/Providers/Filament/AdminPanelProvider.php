<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->darkMode(false)
            ->brandName('Budaya Tutur Voices')
            ->favicon(asset('favicon.ico'))
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                \Filament\Navigation\NavigationGroup::make('Pengarsipan Tutur'),
                \Filament\Navigation\NavigationGroup::make('Wilayah & Geografis'),
                \Filament\Navigation\NavigationGroup::make('Komunikasi'),
            ])
            ->navigationItems([
                \Filament\Navigation\NavigationItem::make('Lihat Website')
                    ->url('/', shouldOpenInNewTab: true)
                    ->icon(\Filament\Support\Icons\Heroicon::OutlinedArrowTopRightOnSquare)
                    ->sort(99),
            ])
            ->font('Plus Jakarta Sans')
            ->colors([
                'primary' => [
                    50 => '#faf9f8',
                    100 => '#f5f3f0', // linen-100
                    200 => '#eae6e1', // linen-200
                    300 => '#d7d0c7', // linen-300
                    400 => '#8a7f73', // ink-500
                    500 => '#3a3530', // obsidian-700
                    600 => '#121110', // main solid action button (Deep Peat Obsidian)
                    700 => '#0c0b0a', // button hover state (Deepest Obsidian)
                    800 => '#000000',
                    900 => '#000000',
                    950 => '#000000',
                ],
                'gray' => Color::Stone,
                'success' => [
                    50 => '#f4f7f5',
                    100 => '#e5ede7',
                    200 => '#cddcd1',
                    300 => '#a7c2af',
                    400 => '#7ba286',
                    500 => '#568463',
                    600 => '#43694e',
                    700 => '#36533f',
                    800 => '#2d4334',
                    900 => '#26382c',
                    950 => '#131e17',
                ],
                'warning' => Color::Amber,
                'danger' => Color::Rose,
                'info' => Color::Slate,
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn (): string => \Illuminate\Support\Facades\Blade::render('@include("filament.admin-custom-styles")'),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \App\Filament\Widgets\WelcomeBannerWidget::class,
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\LatestCultureItemsWidget::class,
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
            ]);
    }
}
