<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;
use App\Models\Compra;
use Illuminate\Support\Facades\Blade;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteCompras extends Page
{
    //protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected string $view = 'filament.admin.pages.reporte-compras';
    public static function getNavigationLabel(): string
    {
        return 'Reporte de Compra';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Reporte de Compras';
    }

    public static function getModelLabel(): string
    {
        return 'Reporte de Compra';
    }
    public $fecha_inicio;
    public $fecha_fin;

    public function mount()
    {
        $this->fecha_inicio = now()->startOfMonth()->format('Y-m-d');
        $this->fecha_fin = now()->format('Y-m-d');
    }

    public function generarPDF()
    {
        $compras = Compra::with(['detalles.producto', 'proveedor', 'usuario', 'tipoPago'])
            ->whereBetween('fecha', [$this->fecha_inicio, $this->fecha_fin])
            ->orderBy('fecha', 'desc')
            ->get();

        $total = $compras->sum('totalcost');

        // PASAMOS LAS VARIABLES, NUNCA $this
        $fecha_inicio = $this->fecha_inicio;
        $fecha_fin = $this->fecha_fin;
        $fecha_generacion = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('pdf.reporte-compras', compact(
            'compras',
            'total',
            'fecha_inicio',
            'fecha_fin',
            'fecha_generacion'
        ));

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'Reporte_Compras_' . now()->format('d-m-Y') . '.pdf'
        );
    }
    public static function getNavigationGroup(): ?string
    {
        return 'REPORTE';
    }
}
