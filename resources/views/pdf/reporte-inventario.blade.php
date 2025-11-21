<!-- resources/views/pdf/reporte-inventario.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inventario - Pa'Consentir</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 30px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px double #333; padding-bottom: 15px; }
        .logo { max-width: 100px; margin-bottom: 10px; }
        h1 { font-size: 28px; color: #1e40af; margin: 0; }
        h2 { font-size: 20px; color: #1e40af; }
        .info { margin: 20px 0; text-align: center; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #1e40af; color: white; padding: 12px; text-align: center; }
        td { padding: 10px; border: 1px solid #999; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .stock-bajo { background-color: #fee2e2; color: #991b1b; font-weight: bold; }
        .stock-ok { background-color: #f0fdf4; color: #166534; }
        .footer { margin-top: 50px; text-align: center; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        @if(file_exists(public_path('storage/logo.png')))
            <img src="{{ public_path('storage/logo.png') }}" class="logo" alt="Logo">
        @endif
        <h1>REPORTE DE INVENTARIO</h1>
        <h2>Sistema Pa'Consentir</h2>
    </div>

    <div class="info">
        <p><strong>Fecha y hora de generación:</strong> {{ $fecha_actual }}</p>
        <p><strong>Total de productos registrados:</strong> {{ $productos->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Unidad</th>
                <th>Stock Actual</th>
                <th>Stock Mínimo</th>
                <th>Stock Máximo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $i => $p)
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td><strong>{{ $p->nombre }}</strong></td>
                <td>{{ $p->categoria?->nombre ?? 'Sin categoría' }}</td>
                <td class="text-center">{{ $p->undmedida?->nombre ?? 'N/A' }}</td>
                <td class="text-center text-lg font-bold">
                    {{ number_format($p->cnt_actual, 2) }}
                </td>
                <td class="text-center">{{ number_format($p->cnt_minima, 2) }}</td>
                <td class="text-center">{{ number_format($p->cnt_maxima, 2) }}</td>
                <td class="text-center">
                    @if($p->cnt_actual <= $p->cnt_minima)
                        <span class="stock-bajo">¡STOCK BAJO!</span>
                    @else
                        <span class="stock-ok">Normal</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No hay productos registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Sistema Pa'Consentir • Reporte de Inventario generado automáticamente</p>
    </div>
</body>
</html>