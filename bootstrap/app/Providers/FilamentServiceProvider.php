<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        
        // Admin Panel
        Filament::serving(function () {
            Filament::registerPanel(
                Panel::make('admin')
                    ->id('admin')
                    ->path('admin')
                    ->colors([
                        'primary' => Color::Blue,
                    ])
                    ->login()
                    ->profile()
                    ->viteTheme('resources/css/filament/admin/theme.css')
                    ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
                    ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
                    ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
                    ->navigationGroups([
                        NavigationGroup::make()
                            ->label('User Management')
                            ->icon('heroicon-o-users'),
                        NavigationGroup::make()
                            ->label('Service Management')
                            ->icon('heroicon-o-wrench-screwdriver'),
                        NavigationGroup::make()
                            ->label('Parts Management')
                            ->icon('heroicon-o-cog-6-tooth'),
                        NavigationGroup::make()
                            ->label('Reports')
                            ->icon('heroicon-o-chart-bar'),
                    ])
            );

            // Customer Panel
            Filament::registerPanel(
                Panel::make('customer')
                    ->id('customer')
                    ->path('customer')
                    ->colors([
                        'primary' => Color::Green,
                    ])
                    ->login()
                    ->registration()
                    ->profile()
                    ->viteTheme('resources/css/filament/customer/theme.css')
                    ->discoverResources(in: app_path('Filament/Customer/Resources'), for: 'App\\Filament\\Customer\\Resources')
                    ->discoverPages(in: app_path('Filament/Customer/Pages'), for: 'App\\Filament\\Customer\\Pages')
                    ->discoverWidgets(in: app_path('Filament/Customer/Widgets'), for: 'App\\Filament\\Customer\\Widgets')
                    ->navigationGroups([
                        NavigationGroup::make()
                            ->label('My Vehicles')
                            ->icon('heroicon-o-truck'),
                        NavigationGroup::make()
                            ->label('Services')
                            ->icon('heroicon-o-wrench-screwdriver'),
                        NavigationGroup::make()
                            ->label('Parts Orders')
                            ->icon('heroicon-o-shopping-cart'),
                    ])
            );

            // Service Station Panel
            Filament::registerPanel(
                Panel::make('service-station')
                    ->id('service-station')
                    ->path('service-station')
                    ->colors([
                        'primary' => Color::Orange,
                    ])
                    ->login()
                    ->registration()
                    ->profile()
                    ->viteTheme('resources/css/filament/service-station/theme.css')
                    ->discoverResources(in: app_path('Filament/ServiceStation/Resources'), for: 'App\\Filament\\ServiceStation\\Resources')
                    ->discoverPages(in: app_path('Filament/ServiceStation/Pages'), for: 'App\\Filament\\ServiceStation\\Pages')
                    ->discoverWidgets(in: app_path('Filament/ServiceStation/Widgets'), for: 'App\\Filament\\ServiceStation\\Widgets')
                    ->navigationGroups([
                        NavigationGroup::make()
                            ->label('Service Operations')
                            ->icon('heroicon-o-wrench-screwdriver'),
                        NavigationGroup::make()
                            ->label('Staff Management')
                            ->icon('heroicon-o-users'),
                        NavigationGroup::make()
                            ->label('Inventory')
                            ->icon('heroicon-o-cube'),
                    ])
            );

            // Vendor Panel
            Filament::registerPanel(
                Panel::make('vendor')
                    ->id('vendor')
                    ->path('vendor')
                    ->colors([
                        'primary' => Color::Purple,
                    ])
                    ->login()
                    ->registration()
                    ->profile()
                    ->viteTheme('resources/css/filament/vendor/theme.css')
                    ->discoverResources(in: app_path('Filament/Vendor/Resources'), for: 'App\\Filament\\Vendor\\Resources')
                    ->discoverPages(in: app_path('Filament/Vendor/Pages'), for: 'App\\Filament\\Vendor\\Pages')
                    ->discoverWidgets(in: app_path('Filament/Vendor/Widgets'), for: 'App\\Filament\\Vendor\\Widgets')
                    ->navigationGroups([
                        NavigationGroup::make()
                            ->label('Parts Catalog')
                            ->icon('heroicon-o-cog-6-tooth'),
                        NavigationGroup::make()
                            ->label('Orders')
                            ->icon('heroicon-o-shopping-bag'),
                        NavigationGroup::make()
                            ->label('Inventory')
                            ->icon('heroicon-o-cube'),
                    ])
            );
        });
    }
}