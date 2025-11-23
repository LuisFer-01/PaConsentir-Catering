<?php

namespace Database\Seeders;

use App\Models\Plato;
use Illuminate\Database\Seeder;

class PlatoSeeder extends Seeder
{
    public function run(): void
    {
        $platos = [
            ['Majadito Paceño', 12.00, 50],
            ['Silpancho Cochabambino', 10.50, 40],
            ['Picante Mixto', 11.00, 35],
            ['Sopa de Maní', 8.00, 60],
            ['Chicharrón con Mote', 13.50, 30],
            ['Saice Tarijeño', 10.00, 45],
            ['Fricase Paceño', 12.50, 35],
        ];

        foreach ($platos as $i => $plato) {
            Plato::create([
                'nombre' => $plato[0],
                'descripcion' => "Plato típico boliviano - {$plato[0]}",
                'precio' => $plato[1],
                'cantidad' => $plato[2],
                'menu_id' => 1,
                'img_ruta' => "platos/plato-" . ($i + 1) . ".png",
                'estado' => 1
            ]);
        }
    }
}
