<?php

namespace App\Filament\Admin\Resources\Ventas\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Venta;
use Carbon\Carbon;

class VentasWidget extends ChartWidget
{
    protected ?string $heading = 'Evolución de Ventas';
    protected ?string $description = 'Comparativa de Ventas del mes actual con el anterior';

    protected int | string | array $columnSpan = 'full';
    protected ?string $maxHeight = '600px';

    protected function getData(): array
    {
        $mesActual = Carbon::now()->month;
        $añoActual = Carbon::now()->year;
        $mesAnterior = Carbon::now()->subMonth()->month;
        $añoAnterior = Carbon::now()->subMonth()->year;

        $datosActual = [];
        $datosAnterior = [];
        $etiquetas = [];

        for ($dia = 1; $dia <= 31; $dia++) {
            $fechaActual = Carbon::create($añoActual, $mesActual, $dia);
            $fechaAnterior = Carbon::create($añoAnterior, $mesAnterior, $dia);

            if ($fechaActual->month !== $mesActual) break;

            $totalActual = Venta::whereDate('fecha', $fechaActual->format('Y-m-d'))->sum('totalprec') ?? 0;
            $totalAnterior = Venta::whereDate('fecha', $fechaAnterior->format('Y-m-d'))->sum('totalprec') ?? 0;

            $etiquetas[] = $dia;
            $datosActual[] = round($totalActual, 2);
            $datosAnterior[] = round($totalAnterior, 2);
        }

        return [
            'datasets' => [
                [
                    'label' => Carbon::now()->translatedFormat('F Y') . ' (Actual)',
                    'data' => $datosActual,
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.15)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#f59e0b',
                    'pointRadius' => 4,
                    'borderWidth' => 3,
                ],
                [
                    'label' => Carbon::now()->subMonth()->translatedFormat('F Y') . ' (Anterior)',
                    'data' => $datosAnterior,
                    'borderColor' => '#94a3b8',
                    'backgroundColor' => 'rgba(148, 163, 184, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointBackgroundColor' => '#94a3b8',
                    'pointRadius' => 3,
                    'borderWidth' => 3,
                    'borderDash' => [8, 5],
                ],
            ],
            'labels' => $etiquetas,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                    'labels' => [
                        'font' => ['size' => 12, 'weight' => 'bold'],
                        'padding' => 15,
                        'usePointStyle' => true,
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "Bs " + value.toLocaleString(); }',
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Día del Mes',
                        'font' => ['size' => 12, 'weight' => 'bold'],
                    ],
                ],
            ],
        ];
    }
}
