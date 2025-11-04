<?php

namespace Database\Seeders;

use App\Models\HprProducto;
use Illuminate\Database\Seeder;

class HprProductoSeeder extends Seeder
{
    public function run(): void
    {
        HprProducto::create([
            'producto_id' => 1,
            'precio_anterior' => 1.00,
            'precio_nuevo' => 1.20,
            'usuario_id' => 1
        ]);
    }
}
