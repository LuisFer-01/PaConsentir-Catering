<?php

namespace Database\Seeders;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class CompraSeeder extends Seeder
{
    public function run(): void
    {
        $fechasCompras = [
            '2025-09-05', '2025-09-15', '2025-09-25',
            '2025-10-03', '2025-10-12', '2025-10-20', '2025-10-28',
            '2025-11-02', '2025-11-09', '2025-11-16', '2025-11-22'
        ];

        foreach ($fechasCompras as $fecha) {
            // CREAR COMPRA CON create() → garantiza que tenga ID inmediatamente
            $compra = Compra::create([
                'proveedor_id'      => rand(1, 5),
                'usuario_id'        => 1,
                'tipodocumento_id'  => rand(1, 2),
                'tipopago_id'       => rand(1, 3),
                'totalcost'         => 0,
                'fecha'             => $fecha,
                'estado'            => 1
            ]);

            // Forzar refresh por si hay observers
            $compra->refresh();

            $totalCompra = 0;
            $detallesCompra = [];
            $cantidadDetalles = rand(6, 8); // Entre 6 y 8 productos por compra

            for ($i = 0; $i < $cantidadDetalles; $i++) {
                $producto = Producto::inRandomOrder()->first();

                $cantidad = rand(20, 150);
                $precioUnitario = $producto->precio;
                $subtotal = round($cantidad * $precioUnitario, 2);

                // Guardamos en array para insert masivo (el más seguro y rápido)
                $detallesCompra[] = [
                    'compra_id'       => $compra->id_compra,        // ← 100% GARANTIZADO
                    'producto_id'     => $producto->id_producto,
                    'cantidad'        => $cantidad,
                    'precio_unitario' => $precioUnitario,
                    'subtotal'        => $subtotal,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ];

                // Actualizar stock del producto
                $producto->increment('cnt_actual', $cantidad);
                $totalCompra += $subtotal;
            }

            // INSERT MASIVO → el más rápido y seguro (nunca falla el compra_id)
            DetalleCompra::insert($detallesCompra);

            // Actualizar total de la compra
            $compra->update(['totalcost' => $totalCompra]);
        }
    }
}
