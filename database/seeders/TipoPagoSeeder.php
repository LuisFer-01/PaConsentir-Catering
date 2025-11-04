<?php

namespace Database\Seeders;

use App\Models\TipoPago;
use Illuminate\Database\Seeder;

class TipoPagoSeeder extends Seeder
{
    public function run(): void
    {
        TipoPago::create(['nombre' => 'Efectivo', 'descripcion' => 'Pago en efectivo', 'estado' => 1]);
        TipoPago::create(['nombre' => 'Tarjeta', 'descripcion' => 'Crédito/Débito', 'estado' => 1]);
        TipoPago::create(['nombre' => 'Transferencia', 'descripcion' => 'Depósito bancario', 'estado' => 1]);
    }
}
