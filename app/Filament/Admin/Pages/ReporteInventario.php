<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;
use App\Models\Producto;
use Illuminate\Support\Facades\Blade;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteInventario extends Page
{
    //protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected string $view = 'filament.admin.pages.reporte-inventario';
    public static function getNavigationLabel(): string
    {
        return 'Reporte de Inventario';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Reporte de Inventario';
    }

    public static function getModelLabel(): string
    {
        return 'Reporte de Inventario';
    }
    public function generarPDF()
    {
        $productos = Producto::with(['categoria', 'undmedida'])
            ->orderBy('nombre')
            ->get();

        $fecha_actual = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('pdf.reporte-inventario', [
            'productos' => $productos,
            'fecha_actual' => $fecha_actual
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Reporte_Inventario_' . now()->format('d-m-Y') . '.pdf'
        );
    }
    public static function getNavigationGroup(): ?string
    {
        return 'REPORTE';
    }
}
