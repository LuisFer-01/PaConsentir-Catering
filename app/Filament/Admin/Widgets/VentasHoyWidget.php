<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Venta;
use Carbon\Carbon;

class VentasHoyWidget extends StatsOverviewWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $mes = Carbon::now()->format('m');
        $año = Carbon::now()->format('Y');
        $hoy = Carbon::today();
        $ventasHoy = Venta::whereDate('fecha', $hoy)->get();

        return [
            Stat::make('Ventas Realizadas Hoy', $ventasHoy->count())
                ->description('Número de ventas registradas')
                ->color('success'),

            Stat::make('Total Vendido Hoy', 'Bs ' . number_format($ventasHoy->sum('totalprec'), 2))
                ->description('Ingresos del día')
                ->color('success'),

            Stat::make('Promedio por Venta', $ventasHoy->count() > 0 ? 'Bs ' . number_format($ventasHoy->avg('totalprec'), 2) : 'Bs 0.00')
                ->description('Ticket promedio')
                ->color('warning'),
            
            Stat::make('Ventas del Mes', 'Bs ' . number_format(Venta::whereMonth('fecha', $mes)->whereYear('fecha', $año)->sum('totalprec'), 2))
                ->description('Acumulado mensual')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),
        ];
    }
}
