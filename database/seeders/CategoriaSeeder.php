<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::create(['nombre' => 'Ingredientes', 'descripcion' => 'Materias primas', 'estado' => 1]);
        Categoria::create(['nombre' => 'Bebidas', 'descripcion' => 'Refrescos, jugos', 'estado' => 1]);
        Categoria::create(['nombre' => 'Utensilios', 'descripcion' => 'Platos, vasos', 'estado' => 1]);
    }
}
