<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Compra;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Plato;
use Carbon\Carbon;

class ResumenGeneralWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $hoy = Carbon::today();
        $mes = Carbon::now()->format('m');
        $año = Carbon::now()->format('Y');

        return [

            /* Stat::make('Ventas del Día', 'Bs ' . number_format(Venta::whereDate('fecha', $hoy)->sum('totalprec'), 2))
                ->description('Total vendido hoy')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'), */

            /* Stat::make('Stock Crítico', Producto::whereColumn('cnt_actual', '<=', 'cnt_minima')->count() . ' productos')
                ->description('Requieren reposición urgente')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'), */
        ];
    }
}
