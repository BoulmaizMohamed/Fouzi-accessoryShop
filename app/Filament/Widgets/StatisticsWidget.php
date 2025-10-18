<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;

class StatisticsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            
            Stat::make('Total Orders', Order::count())
                ->description('All orders')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('info'),
            
            Stat::make('Total Products', Product::count())
                ->description('Products in catalog')
                ->descriptionIcon('heroicon-m-cube')
                ->color('warning'),
            
            Stat::make('Total Categories', Category::count())
                ->description('Product categories')
                ->descriptionIcon('heroicon-m-tag')
                ->color('primary'),
            
            Stat::make('Total Revenue', '€' . number_format(Order::where('status', 'accepted')->sum('total'), 2))
                ->description('From completed orders')
                ->descriptionIcon('heroicon-m-currency-euro')
                ->color('success'),
            
            Stat::make('Pending Orders', Order::where('status', 'pending')->count())
                ->description('Awaiting processing')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),
        ];
    }
}
