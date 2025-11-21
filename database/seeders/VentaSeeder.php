<?php

namespace Database\Seeders;

use App\Models\Venta;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        Venta::create([
            'cliente_id' => 1,
            'usuario_id' => 1,
            'tipodocumento_id' => 2,
            'tipopago_id' => 1,
            'totalprec' => 17.00,
            'fecha' => '2025-11-04',
            'estado' => 1
        ]);
    }
}
