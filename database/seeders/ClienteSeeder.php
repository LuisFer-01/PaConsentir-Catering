<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create([
            'nombre' => 'María',
            'apellido' => 'González',
            'telefono' => '04241234567',
            'email' => 'maria@gmail.com',
            'direccion' => 'Urbanización Los Flores',
            'ci' => 'V-12345678',
            'estado' => 1
        ]);
    }
}
