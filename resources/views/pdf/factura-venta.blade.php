<!-- resources/views/pdf/factura-venta.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #{{ str_pad($venta->id_venta, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 0; padding: 20px; font-size: 12px; color: #333; }
        .container { width: 100%; max-width: 800px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 3px double #333; padding-bottom: 10px; }
        .logo { max-width: 120px; margin-bottom: 10px; }
        .info { display: flex; justify-content: space-between; margin: 20px 0; }
        .info div { width: 48%; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .text-right { text-align: right; }
        .total { font-size: 16px; font-weight: bold; }
        .footer { margin-top: 40px; text-align: center; font-size: 10px; color: #666; }
        .qr { text-align: center; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">

        <div class="header">
            @if(file_exists(public_path('storage/tienda/Logo-Color-PaConsentir.png')))
                <img src="{{ public_path('storage/tienda/Logo-Color-PaConsentir.png') }}" alt="Logo" class="logo">
            @endif
            <h1>SISTEMA Pa'Consentir</h1>
            <p>Catering & Eventos</p>
            <h2>FACTURA DE VENTA</h2>
            <h3>N° {{ str_pad($venta->id_venta, 6, '0', STR_PAD_LEFT) }}</h3>
        </div>

        <div class="info">
            <div>
                <strong>Cliente:</strong> {{ $venta->cliente?->nombre ?? 'Cliente General' }}<br>
                <strong>CI/NIT:</strong> {{ $venta->cliente?->ci_nit ?? 'Sin registro' }}<br>
                <strong>Teléfono:</strong> {{ $venta->cliente?->telefono ?? '---' }}
            </div>
            <div class="text-right">
                <strong>Fecha:</strong> {{ $venta->fecha->format('d/m/Y') }}<br>
                <strong>Vendedor:</strong> {{ $venta->usuario->name }}<br>
                <strong>Tipo Pago:</strong> {{ $venta->tipoPago->nombre }}
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Plato</th>
                    <th>Cantidad</th>
                    <th>Precio Unit.</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalles as $i => $detalle)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $detalle->plato->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>Bs {{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>Bs {{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="text-align: right; margin-top: 20px;">
            <h2 class="total">TOTAL A PAGAR: Bs {{ number_format($venta->totalprec, 2) }}</h2>

            <!-- TOTAL EN LETRAS - SIN ERRORES DE SINTAXIS -->
            @php
                $unidades = ["", "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE"];
                $decenas = ["", "DIEZ", "VEINTE", "TREINTA", "CUARENTA", "CINCUENTA", "SESENTA", "SETENTA", "OCHENTA", "NOVENTA"];
                $centenas = ["", "CIENTO", "DOSCIENTOS", "TRESCIENTOS", "CUATROCIENTOS", "QUINIENTOS", "SEISCIENTOS", "SETECIENTOS", "OCHOCIENTOS", "NOVECIENTOS"];
                $especiales = ["DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE"];

                $entero = floor($venta->totalprec);
                $decimal = round(($venta->totalprec - $entero) * 100);
                $resultado = "";

                if ($entero == 0) {
                    $resultado = "CERO BOLIVIANOS";
                } elseif ($entero == 1) {
                    $resultado = "UN BOLIVIANO";
                } else {
                    if ($entero >= 1000000) {
                        $millones = floor($entero / 1000000);
                        $resultado .= ($millones == 1 ? "UN MILLÓN" : ($millones < 10 ? $unidades[$millones] : "") . " MILLONES") . " ";
                        $entero %= 1000000;
                    }
                    if ($entero >= 1000) {
                        $miles = floor($entero / 1000);
                        $resultado .= ($miles == 1 ? "MIL" : ($miles < 10 ? $unidades[$miles] : "") . " MIL") . " ";
                        $entero %= 1000;
                    }
                    if ($entero >= 100) {
                        $centena = floor($entero / 100);
                        $resultado .= ($centena == 1 && $entero % 100 == 0 ? "CIEN" : $centenas[$centena]) . " ";
                        $entero %= 100;
                    }
                    if ($entero >= 20) {
                        $decena = floor($entero / 10);
                        $resultado .= $decenas[$decena] . " ";
                        $entero %= 10;
                        if ($entero > 0) $resultado .= "Y ";
                    } elseif ($entero >= 10) {
                        $resultado .= $especiales[$entero - 10] . " ";
                        $entero = 0;
                    }
                    if ($entero > 0) {
                        $resultado .= $unidades[$entero] . " ";
                    }
                    $resultado = trim($resultado);
                    $resultado .= " BOLIVIANOS";
                }

                if ($decimal > 0) {
                    $resultado .= " CON " . str_pad($decimal, 2, "0", STR_PAD_LEFT) . "/100";
                }
            @endphp

            <p><strong>Son:</strong> {{ trim($resultado) }}</p>
        </div>

        <div class="qr">
            {!! QrCode::size(150)->generate(route('venta.pdf', $venta->id_venta)) !!}
            <br><small>Escanea para ver factura digital</small>
        </div>

        <div class="footer">
            <p>Gracias por su preferencia • Este documento es generado electrónicamente</p>
            <p>Pa'Consentir - Tel: +591 XXX XXXX • www.paconsentir.com</p>
        </div>
    </div>
</body>
</html>