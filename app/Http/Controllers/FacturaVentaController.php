<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Kwn\NumberToWords\NumberToWords;

class FacturaVentaController extends Controller
{
    public function generar(Venta $venta)
    {
        // Cargar relaciones
        $venta->load(['detalles.plato', 'cliente', 'usuario', 'tipoPago']);

        $pdf = Pdf::loadView('pdf.factura-venta', compact('venta'));

        $pdf->setPaper('letter');

        return $pdf->stream('Factura_Venta_'.$venta->id_venta.'.pdf');
        // O descarga directa:
        // return $pdf->download('Factura_'.$venta->id_venta.'.pdf');
    }
}
