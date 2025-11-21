<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas - Pa'Consentir</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        h1 { text-align: center; color: #1e40af; font-size: 24px; margin-bottom: 5px; }
        .header { text-align: center; margin-bottom: 20px; }
        .info { margin: 15px 0; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background-color: #1e40af; color: white; font-weight: bold; }
        .text-right { text-align: right; }
        .total-row { background-color: #f0f9ff; font-weight: bold; font-size: 16px; }
        .footer { margin-top: 50px; text-align: center; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>REPORTE DE VENTAS</h1>
        <h2>Sistema Pa'Consentir</h2>
    </div>

    <div class="info">
        <p><strong>Período:</strong> {{ \Carbon\Carbon::parse($fecha_inicio)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($fecha_fin)->format('d/m/Y') }}</p>
        <p><strong>Generado el:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Platos</th>
                <th>Vendedor</th>
                <th class="text-right">Total (Bs)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ventas as $i => $venta)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $venta->fecha->format('d/m/Y') }}</td>
                <td>{{ $venta->cliente?->nombre ?? 'Cliente General' }}</td>
                <td>{{ $venta->detalles->count() }}</td>
                <td>{{ $venta->usuario->name }}</td>
                <td class="text-right">Bs {{ number_format($venta->totalprec, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; font-style:italic; color:#999;">
                    No se encontraron ventas en este período
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" class="text-right"><strong>TOTAL GENERAL:</strong></td>
                <td class="text-right"><strong>Bs {{ number_format($total, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Sistema Pa'Consentir • Reporte generado automáticamente</p>
    </div>
</body>
</html>