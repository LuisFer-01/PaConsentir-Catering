<?php

namespace App\Filament\Admin\Resources\Platos\Widgets;

use Filament\Widgets\ChartWidget;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\DetalleVenta;
use Flowframe\Trend\Trend;

class TopPlatosWidget extends ApexChartWidget
{
    protected static ?string $heading = 'Top 10 Platos Más Vendidos (Este Mes)';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full'; // ← FULL SCREEN
    protected static ?string $maxHeight = '500px';

    protected function getOptions(): array
    {
        $data = DetalleVenta::with('plato')
            ->whereHas('venta', fn($q) => $q->whereMonth('fecha', now()->month))
            ->selectRaw('plato_id, SUM(cantidad) as total')
            ->groupBy('plato_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 600,
                'toolbar' => ['show' => true],
            ],
            'series' => [
                [
                    'name' => 'Porciones Vendidas',
                    'data' => $data->pluck('total')->toArray(),
                ],
            ],
            'xaxis' => [
                'categories' => $data->map(fn($i) => $i->plato?->nombre ?? 'Sin nombre')->toArray(),
                'labels' => ['style' => ['fontSize' => '14px', 'fontWeight' => 600]],
            ],
            'yaxis' => [
                'labels' => ['style' => ['fontSize' => '14px']],
            ],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 8,
                    'horizontal' => true,
                    'barHeight' => '60%',
                ],
            ],
            'dataLabels' => [
                'enabled' => true,
                'style' => ['fontSize' => '16px', 'fontWeight' => 'bold'],
                'offsetX' => 10,
            ],
            'colors' => ['#f59e0b'],
            'grid' => ['show' => false],
        ];
    }
}
