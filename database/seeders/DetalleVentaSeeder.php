<?php

namespace Database\Seeders;

use App\Models\DetalleVenta;
use Illuminate\Database\Seeder;

class DetalleVentaSeeder extends Seeder
{
    public function run(): void
    {
        DetalleVenta::create([
            'venta_id' => 1,
            'plato_id' => 1,
            'cantidad' => 2,
            'precio_unitario' => 8.50,
            'subtotal' => 17.00
        ]);
    }
}
