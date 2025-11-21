<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;
use App\Models\Venta;
use Illuminate\Support\Facades\Blade;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Support\Icons\Heroicon;

class ReporteVentas extends Page
{
    //protected static string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected string $view = 'filament.admin.pages.reporte-ventas';
    public static function getNavigationLabel(): string
    {
        return 'Reporte de Venta';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Reporte de Ventas';
    }

    public static function getModelLabel(): string
    {
        return 'Reporte de Venta';
    }
    public $fecha_inicio;
    public $fecha_fin;
    public function mount()
    {
        $this->fecha_inicio = now()->format('Y-m-d');
        $this->fecha_fin = now()->format('Y-m-d');
    }

    public function generarPDF()
    {
        $ventas = Venta::with(['detalles.plato', 'cliente', 'usuario'])
            ->whereBetween('fecha', [$this->fecha_inicio, $this->fecha_fin])
            ->orderBy('fecha', 'desc')
            ->get();

        $total = $ventas->sum('totalprec');

        // PASAR LAS FECHAS COMO VARIABLES
        $fecha_inicio = $this->fecha_inicio;
        $fecha_fin = $this->fecha_fin;

        $pdf = Pdf::loadView('pdf.reporte-ventas', compact('ventas', 'total', 'fecha_inicio', 'fecha_fin'));
        
        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Reporte_Ventas_' . now()->format('d-m-Y') . '.pdf'
        );
    }
    public static function getNavigationGroup(): ?string
    {
        return 'REPORTE';
    }
}
