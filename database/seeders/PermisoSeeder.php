<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    public function run(): void
    {
        Permiso::create(['nombre' => 'Gestión Total', 'descripcion' => 'Acceso completo', 'estado' => 1]);
        Permiso::create(['nombre' => 'Solo Lectura', 'descripcion' => 'Ver sin modificar', 'estado' => 1]);
        Permiso::create(['nombre' => 'Adición', 'descripcion' => 'Crear registros', 'estado' => 1]);
        Permiso::create(['nombre' => 'Edición', 'descripcion' => 'Modificar registros', 'estado' => 1]);
        Permiso::create(['nombre' => 'Eliminación', 'descripcion' => 'Desactivar registros', 'estado' => 1]);
    }
}
