<?php

namespace App\Observers;

use App\Models\Rol;
use App\Models\DetallePermiso;
use App\Models\Permiso;

class RolObserver
{
    public function created(Rol $rol)
    {
        // Admin (id_rol = 1) ya tiene todo → no hacer nada
        if ($rol->id_rol == 1) {
            return;
        }

        $permisos = Permiso::all();

        foreach ($permisos as $permiso) {
            DetallePermiso::create([
                'rol_id' => $rol->id_rol,
                'permiso_id' => $permiso->id_permiso,
                'estado' => 0, // Inactivo por defecto
            ]);
        }
    }
}