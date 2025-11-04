<?php

namespace Database\Seeders;

use App\Models\Compra;
use Illuminate\Database\Seeder;

class CompraSeeder extends Seeder
{
    public function run(): void
    {
        Compra::create([
            'proveedor_id' => 1,
            'usuario_id' => 1,
            'tipodocumento_id' => 1,
            'tipopago_id' => 1,
            'totalcost' => 60.00,
            'fecha' => '2025-11-03',
            'estado' => 1
        ]);
    }
}
