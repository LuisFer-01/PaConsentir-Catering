<?php

namespace Database\Seeders;

use App\Models\Receta;
use Illuminate\Database\Seeder;

class RecetaSeeder extends Seeder
{
    public function run(): void
    {
        Receta::create([
            'plato_id' => 1,
            'ingrediente_id' => 1,
            'cantidad' => 0.30,
            'estado' => 1
        ]);
    }
}
