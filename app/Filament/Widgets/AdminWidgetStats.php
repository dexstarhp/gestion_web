<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminWidgetStats extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Sale::whereMonth('date', now()->month)->sum('total');
        $totalPurchases = Purchase::whereMonth('date', now()->month)->sum('total');
        $lowStockProducts = Product::where('min_stock', '<', \DB::raw('min_stock'))->count();
        return [
            Stat::make('Ventas del Mes', 'Bs ' . number_format($total, 2))
                ->description('Ventas registradas este mes')
                ->color('success'),


            Stat::make('Compras del Mes', 'Bs ' . number_format($totalPurchases, 2))
                ->description('Compras totales este mes')
                ->color('primary'),
            Stat::make('Productos con Stock Bajo', $lowStockProducts)
                ->description('Productos con stock inferior al mínimo')
                ->color('danger'),
        ];
    }
}
