<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            ['Arroz Blanco Premium', 1.20, 4, 1, 10, 200],
            ['Carne de Res (kg)', 8.50, 1, 1, 20, 150],
            ['Pollo Entero (kg)', 3.80, 1, 1, 30, 200],
            ['Queso Blanco (kg)', 5.20, 2, 1, 15, 100],
            ['Leche Entera (L)', 1.80, 2, 2, 50, 300],
            ['Tomate (kg)', 0.90, 3, 1, 20, 200],
            ['Cebolla (kg)', 0.75, 3, 1, 25, 200],
            ['Papa (kg)', 0.65, 3, 1, 30, 300],
            ['Coca Cola 2L', 2.50, 5, 2, 20, 200],
            ['Harina de Maíz (kg)', 1.10, 4, 1, 50, 500],
            ['Aceite Vegetal (L)', 3.20, 6, 2, 30, 200],
            ['Sal (kg)', 0.40, 6, 1, 10, 100],
            ['Azúcar (kg)', 1.05, 4, 1, 40, 300],
            ['Huevos (30 und)', 4.50, 1, 3, 10, 100],
            ['Plátanos (kg)', 0.85, 3, 1, 25, 200],
        ];

        foreach ($productos as $p) {
            Producto::create([
                'nombre' => $p[0],
                'descripcion' => "Producto de alta calidad - {$p[0]}",
                'precio' => $p[1],
                'categoria_id' => $p[2],
                'undmedida_id' => $p[3],
                'img_ruta' => 'productos/default.png',
                'cnt_minima' => $p[4],
                'cnt_actual' => rand(50, 250),
                'cnt_maxima' => $p[5],
                'estado' => 1
            ]);
        }
    }
}
