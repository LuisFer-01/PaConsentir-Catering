<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        Rol::create(['nombre' => 'Administrador', 'descripcion' => 'Acceso total al sistema', 'estado' => 1]);
        Rol::create(['nombre' => 'Vendedor', 'descripcion' => 'Gestiona ventas y clientes', 'estado' => 1]);
        Rol::create(['nombre' => 'Almacén', 'descripcion' => 'Gestiona compras e inventario', 'estado' => 1]);
    }
}
