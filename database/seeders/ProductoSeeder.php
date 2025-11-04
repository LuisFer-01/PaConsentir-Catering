<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Arroz Blanco',
            'descripcion' => 'Arroz premium 1kg',
            'precio' => 1.20,
            'categoria_id' => 1,
            'undmedida_id' => 1,
            'estado' => 1
        ]);
        Producto::create([
            'nombre' => 'Coca Cola 2L',
            'descripcion' => 'Bebida gaseosa',
            'precio' => 2.50,
            'categoria_id' => 2,
            'undmedida_id' => 2,
            'estado' => 1
        ]);
    }
}
