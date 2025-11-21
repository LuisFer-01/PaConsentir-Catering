<!-- resources/views/pdf/reporte-compras.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Compras - Pa'Consentir</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 30px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px double #333; padding-bottom: 15px; }
        .logo { max-width: 100px; margin-bottom: 10px; }
        h1 { font-size: 28px; color: #16a34a; margin: 0; }
        h2 { font-size: 20px; color: #16a34a; }
        .info { margin: 20px 0; text-align: center; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #16a34a; color: white; padding: 12px; text-align: center; }
        td { padding: 10px; border: 1px solid #999; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .total-row { background-color: #f0fdf4; font-weight: bold; font-size: 16px; }
        .footer { margin-top: 50px; text-align: center; font-size: 10px; color: #666; }
        .detalle { margin-top: 8px; font-size: 11px; background: #f9fafb; padding: 6px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        @if(file_exists(public_path('storage/logo.png')))
            <img src="{{ public_path('storage/logo.png') }}" class="logo" alt="Logo">
        @endif
        <h1>REPORTE DE COMPRAS</h1>
        <h2>Sistema Pa'Consentir</h2>
    </div>

    <div class="info">
        <p><strong>Período:</strong> {{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</p>
        <p><strong>Generado el:</strong> {{ $fecha_generacion }}</p>
        <p><strong>Total de compras:</strong> {{ $compras->count() }}</p>
    </div>

    @foreach($compras as $compra)
        <div style="margin-bottom: 30px; border: 1px solid #ccc; padding: 15px; border-radius: 8px;">
            <h3 style="background:#16a34a; color:white; padding:8px; border-radius:6px; margin:0 0 10px 0;">
                COMPRA N° {{ $compra->id_compra }} • {{ $compra->fecha->format('d/m/Y') }}
            </h3>
            <p><strong>Proveedor:</strong> {{ $compra->proveedor?->nombre ?? 'Sin proveedor' }}</p>
            <p><strong>Usuario:</strong> {{ $compra->usuario->name }}</p>
            <p><strong>Tipo Pago:</strong> {{ $compra->tipoPago->nombre }}</p>

            <table style="margin-top:10px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unit.</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($compra->detalles as $i => $detalle)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td class="text-center">{{ number_format($detalle->cantidad, 2) }}</td>
                        <td class="text-right">Bs {{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td class="text-right">Bs {{ number_format($detalle->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="4" class="text-right"><strong>TOTAL COMPRA:</strong></td>
                        <td class="text-right"><strong>Bs {{ number_format($compra->totalcost, 2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endforeach

    <div style="text-align: right; margin-top: 30px; padding: 15px; background: #dcfce7; border-radius: 8px;">
        <h2 style="margin:0; color:#166534;">
            TOTAL GENERAL DE COMPRAS: Bs {{ number_format($total, 2) }}
        </h2>
    </div>

    <div class="footer">
        <p>Sistema Pa'Consentir • Reporte generado automáticamente</p>
    </div>
</body>
</html>