<?php

namespace Database\Seeders;

use App\Models\UndMedida;
use Illuminate\Database\Seeder;

class UndMedidaSeeder extends Seeder
{
    public function run(): void
    {
        $unidades = ['Kilogramo', 'Litro', 'Unidad', 'Paquete', 'Caja', 'Bolsa'];
        foreach ($unidades as $und) {
            UndMedida::create(['nombre' => $und, 'descripcion' => substr($und, 0, 3), 'estado' => 1]);
        }
    }
}
