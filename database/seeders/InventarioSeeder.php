<?php

namespace Database\Seeders;

use App\Models\Inventario;
use Illuminate\Database\Seeder;

class InventarioSeeder extends Seeder
{
    public function run(): void
    {
        Inventario::create([
            'producto_id' => 1,
            'tipo' => 'compra',
            'cantidad' => 50.00,
            'fecha' => '2025-11-03',
            'referencia' => 1
        ]);
    }
}
