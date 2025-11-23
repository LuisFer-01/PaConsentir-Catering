<?php

namespace Database\Seeders;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class DetalleCompraSeeder extends Seeder
{
    public function run(): void
    {
        $compras = Compra::all();

        if ($compras->isEmpty()) {
            $this->command->error('No hay compras creadas. Ejecuta primero CompraSeeder');
            return;
        }

        foreach ($compras as $compra) {
            $totalCompra = 0;
            $numDetalles = rand(4, 8); // Entre 4 y 8 detalles por compra

            for ($i = 0; $i < $numDetalles; $i++) {
                $producto = Producto::inRandomOrder()->first();
                $cantidad = rand(20, 150);
                $precio   = $producto->precio;
                $subtotal = round($cantidad * $precio, 2);

                DetalleCompra::create([
                    'compra_id'       => $compra->id_compra,     // ← 100% existe
                    'producto_id'     => $producto->id_producto,
                    'cantidad'        => $cantidad,
                    'precio_unitario' => $precio,
                    'subtotal'        => $subtotal,
                ]);

                $producto->increment('cnt_actual', $cantidad);
                $totalCompra += $subtotal;
            }

            $compra->update(['totalcost' => $totalCompra]);
        }
    }
}
