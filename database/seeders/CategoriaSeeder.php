<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = ['Carnes', 'Lácteos', 'Verduras', 'Granos', 'Bebidas', 'Condimentos', 'Utensilios'];
        foreach ($categorias as $cat) {
            Categoria::create(['nombre' => $cat, 'descripcion' => "Categoría $cat", 'estado' => 1]);
        }
    }
}
