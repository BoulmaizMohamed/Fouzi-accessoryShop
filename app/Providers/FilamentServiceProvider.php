<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Filament\Widgets\StatisticsWidget;

class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Widgets are automatically discovered, no need to manually register
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->widgets([
                StatisticsWidget::class,
            ]);
    }
}