<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::create([
            'nombre' => 'Menú Semanal',
            'descripcion' => 'Del 04 al 10 de Noviembre',
            'fecha_inicio' => '2025-11-04',
            'fecha_fin' => '2025-11-10',
            'estado' => 1
        ]);
    }
}
