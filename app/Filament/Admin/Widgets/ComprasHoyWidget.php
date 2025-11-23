<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Compra;
use Carbon\Carbon;

class ComprasHoyWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $hoy = Carbon::today();
        $mes = Carbon::now()->format('m');
        $año = Carbon::now()->format('Y');
        $hoy = Carbon::today();
        $comprasHoy = Compra::whereDate('fecha', $hoy)->sum('totalcost');

        return [
            Stat::make('Gasto en Compras Hoy', 'Bs ' . number_format($comprasHoy, 2))
                ->description('Total invertido en compras')
                ->color('danger'),
            Stat::make('Gastos en Compras del Mes', 'Bs ' . number_format(Compra::whereMonth('fecha', $mes)->whereYear('fecha', $año)->sum('totalcost'), 2))
                ->description('Acumulado mensual')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),
        ];
    }
}
