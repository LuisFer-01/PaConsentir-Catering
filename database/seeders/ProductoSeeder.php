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
            'img_ruta' => 'productos/default-producto-01.png',
            'cnt_minima' => 10.00,
            'cnt_actual' => 50.00,
            'cnt_maxima' => 200.00,
            'estado' => 1
        ]);
        Producto::create([
            'nombre' => 'Coca Cola 2L',
            'descripcion' => 'Bebida gaseosa',
            'precio' => 2.50,
            'categoria_id' => 2,
            'undmedida_id' => 2,
            'img_ruta' => 'productos/default-producto-01.png',
            'cnt_minima' => 5.00,
            'cnt_actual' => 30.00,
            'cnt_maxima' => 100.00,
            'estado' => 1
        ]);
    }
}
