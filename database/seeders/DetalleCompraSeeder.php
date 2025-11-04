<?php

namespace Database\Seeders;

use App\Models\DetalleCompra;
use Illuminate\Database\Seeder;

class DetalleCompraSeeder extends Seeder
{
    public function run(): void
    {
        DetalleCompra::create([
            'compra_id' => 1,
            'producto_id' => 1,
            'cantidad' => 50,
            'precio_unitario' => 1.20,
            'subtotal' => 60.00
        ]);
    }
}
