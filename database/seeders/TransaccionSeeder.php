<?php

namespace Database\Seeders;

use App\Models\Transaccion;
use Illuminate\Database\Seeder;

class TransaccionSeeder extends Seeder
{
    public function run(): void
    {
        Transaccion::create([
            'usuario_id' => 1,
            'tipo' => 'COMPRA',
            'descripcion' => 'Compra inicial de arroz',
            'monto' => 60.00
        ]);
    }
}
