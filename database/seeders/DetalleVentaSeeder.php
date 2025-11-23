<?php

namespace Database\Seeders;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Plato;
use Illuminate\Database\Seeder;

class DetalleVentaSeeder extends Seeder
{
    public function run(): void
    {
        $ventas = Venta::all();

        foreach ($ventas as $venta) {
            $totalVenta = 0;
            $numDetalles = rand(2, 6);

            for ($i = 0; $i < $numDetalles; $i++) {
                $plato = Plato::inRandomOrder()->first();
                $cantidad = rand(1, 5);
                $subtotal = round($cantidad * $plato->precio, 2);

                DetalleVenta::create([
                    'venta_id'         => $venta->id,     // ← ID 100% EXISTENTE
                    'plato_id'         => $plato->id,
                    'cantidad'         => $cantidad,
                    'precio_unitario'  => $plato->precio,
                    'subtotal'         => $subtotal,
                ]);

                $totalVenta += $subtotal;
            }

            $venta->update(['totalprec' => $totalVenta]);
        }
    }
}
