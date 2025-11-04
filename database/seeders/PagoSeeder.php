<?php

namespace Database\Seeders;

use App\Models\Pago;
use Illuminate\Database\Seeder;

class PagoSeeder extends Seeder
{
    public function run(): void
    {
        Pago::create([
            'venta_id' => 1,
            'tipopago_id' => 1,
            'monto' => 17.00,
            'fecha_pago' => '2025-11-04',
            'estado' => 1
        ]);
    }
}
