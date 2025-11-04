<?php

namespace Database\Seeders;

use App\Models\PlatoImg;
use Illuminate\Database\Seeder;

class PlatoImgSeeder extends Seeder
{
    public function run(): void
    {
        PlatoImg::create([
            'plato_id' => 1,
            'img_ruta' => 'platos/pabellon.jpg',
            'estado' => 1
        ]);
    }
}
