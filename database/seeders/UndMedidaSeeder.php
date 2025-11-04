<?php

namespace Database\Seeders;

use App\Models\UndMedida;
use Illuminate\Database\Seeder;

class UndMedidaSeeder extends Seeder
{
    public function run(): void
    {
        UndMedida::create(['nombre' => 'Kilogramo', 'descripcion' => 'kg', 'estado' => 1]);
        UndMedida::create(['nombre' => 'Litro', 'descripcion' => 'L', 'estado' => 1]);
        UndMedida::create(['nombre' => 'Unidad', 'descripcion' => 'und', 'estado' => 1]);
    }
}
