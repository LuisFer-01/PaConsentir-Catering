<?php

namespace Database\Seeders;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Plato;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        $fechasVenta = [
            ...array_merge(...array_map(fn($d) => [$d, $d, $d, $d, $d], [
                '2025-09-06', '2025-09-13', '2025-09-21', '2025-09-29',
                '2025-10-04', '2025-10-11', '2025-10-19', '2025-10-26',
                '2025-11-02', '2025-11-09', '2025-11-16', '2025-11-21'
            ]))
        ];

        foreach ($fechasVenta as $fecha) {
            $venta = Venta::create([
                'cliente_id' => 1,
                'usuario_id' => 1,
                'tipodocumento_id' => 2,
                'tipopago_id' => rand(1, 3),
                'totalprec' => 0,
                'fecha' => $fecha,
                'estado' => 1
            ]);

            $total = 0;
            $detalles = rand(1, 5);
            for ($i = 0; $i < $detalles; $i++) {
                $plato_id = rand(1, 7);
                $cantidad = rand(1, 6);
                $plato = Plato::find($plato_id);
                $subtotal = $cantidad * $plato->precio;
                $total += $subtotal;

                DetalleVenta::create([
                    'venta_id' => $venta->id_venta,
                    'plato_id' => $plato_id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $plato->precio,
                    'subtotal' => $subtotal
                ]);
            }

            $venta->update(['totalprec' => $total]);
        }
    }
}
