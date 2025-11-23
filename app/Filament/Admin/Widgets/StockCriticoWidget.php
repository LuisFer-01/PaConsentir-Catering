<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use App\Models\Producto;

class StockCriticoWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $criticos = Producto::whereColumn('cnt_actual', '<=', 'cnt_minima')->get();

        return [
            Stat::make('Productos en Stock', Producto::where('cnt_actual', '>', 0)->count() . ' / ' . Producto::count())
                ->description('Disponibles / Total')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),
                
            Stat::make('Productos con Stock Bajo', $criticos->count())
                ->description($criticos->count() > 0 ? $criticos->pluck('nombre')->take(3)->implode(', ') : 'Todo en orden')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($criticos->count() > 0 ? 'danger' : 'success'),
        ];
    }
}
