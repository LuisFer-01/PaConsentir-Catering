<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tienda;

class TiendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tienda::create(['nombre' => "Pa'Consentir", 'direccion' => 'Av Virgen de Cotoca', 'img_ruta' => 'tienda/Logo-Color-PaConsentir.png']);
    }
}
