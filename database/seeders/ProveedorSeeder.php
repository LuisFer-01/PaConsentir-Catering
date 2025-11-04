<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        Proveedor::create([
            'nombre' => 'Distribuidora El Sabor',
            'contacto' => 'Juan Pérez',
            'telefono' => '04141234567',
            'email' => 'juan@elsabor.com',
            'direccion' => 'Av. Principal, Valencia',
            'estado' => 1
        ]);
    }
}
