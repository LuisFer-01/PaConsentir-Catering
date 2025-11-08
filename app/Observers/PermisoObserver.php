<?php

namespace App\Observers;

use App\Models\Permiso;
use App\Models\DetallePermiso;
use App\Models\Rol;
use Filament\Facades\Filament;

class PermisoObserver
{
    public function created(Permiso $permiso)
    {
        $roles = Rol::all();

        foreach ($roles as $rol) {
            $estado = ($rol->id_rol == 1) ? 1 : 0;

            DetallePermiso::create([
                'rol_id' => $rol->id_rol,
                'permiso_id' => $permiso->id_permiso,
                'estado' => $estado,
            ]);
        }
    }
}