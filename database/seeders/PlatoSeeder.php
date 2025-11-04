<?php

namespace Database\Seeders;

use App\Models\Plato;
use Illuminate\Database\Seeder;

class PlatoSeeder extends Seeder
{
    public function run(): void
    {
        Plato::create([
            'nombre' => 'Pabellón Criollo',
            'descripcion' => 'Arroz, carne, caraotas, plátano',
            'precio' => 8.50,
            'menu_id' => 1,
            'estado' => 1
        ]);
    }
}
