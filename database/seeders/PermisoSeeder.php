<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\Permiso;
use App\Models\DetallePermiso;
use Filament\Facades\Filament;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermisoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Obtener todos los Resources de Filament
        $resources = Filament::getResources();

        // 2. Crear permisos base con ruta y grupo
        $acciones = [
            'Gestión Total' => ['ruta_suffix' => '/*', 'permiso' => 'Gestión Total'],
            'Lectura'  => ['ruta_suffix' => '',    'permiso' => 'Lectura'],
            'Adición'       => ['ruta_suffix' => '/create', 'permiso' => 'Adición'],
            'Edición'       => ['ruta_suffix' => '/{record}/edit', 'permiso' => 'Edición'],
            'Eliminación'   => ['ruta_suffix' => '/{record}', 'permiso' => 'Eliminación'],
        ];

        $permisosCreados = collect();

        foreach ($resources as $resource) {
            $baseRoute = $this->getBaseRoute($resource);
            $grupo = $this->getGrupo($resource);

            foreach ($acciones as $nombre => $data) {
                $ruta = $baseRoute . $data['ruta_suffix'];

                $permiso = Permiso::updateOrCreate(
                    ['nombre' => $nombre, 'ruta' => $ruta],
                    [
                        'descripcion' => $this->getDescripcion($nombre),
                        'grupo' => $grupo,
                        'estado' => 1,
                    ]
                );

                $permisosCreados->push($permiso);
            }
        }

        // 3. Asignar TODOS los permisos al Admin (id_rol = 1)
        $admin = Rol::find(1);
        if ($admin) {
            $this->assignPermissionsToRole($admin, $permisosCreados, true);
        }

        // 4. Asignar permisos INACTIVOS a otros roles
        $otrosRoles = Rol::where('id_rol', '!=', 1)->get();
        foreach ($otrosRoles as $rol) {
            $this->assignPermissionsToRole($rol, $permisosCreados, false);
        }
    }

    private function assignPermissionsToRole($rol, $permisos, $activo = true)
    {
        foreach ($permisos as $permiso) {
            DetallePermiso::updateOrCreate(
                [
                    'rol_id' => $rol->id_rol,
                    'permiso_id' => $permiso->id_permiso,
                ],
                [
                    'estado' => $activo ? 1 : 0,
                ]
            );
        }
    }

    private function getBaseRoute($resource): string
    {
        $name = class_basename($resource);
        $slug = strtolower(str_replace('Resource', '', $name));
        return "/admin/resources/{$slug}";
    }

    private function getGrupo($resource): string
    {
        $name = class_basename($resource);

        return match (true) {
            str_contains($name, 'User') || str_contains($name, 'Rol') || str_contains($name, 'Permiso') => 'ADMINISTRACIÓN',
            str_contains($name, 'Producto') || str_contains($name, 'Categoria') || str_contains($name, 'UndMedida') || str_contains($name, 'TipoDocumento') || str_contains($name, 'TipoPago') => 'PARÁMETROS',
            str_contains($name, 'Proveedor') || str_contains($name, 'Compra') => 'COMPRA',
            str_contains($name, 'Cliente') || str_contains($name, 'Venta') || str_contains($name, 'Pago') => 'VENTA',
            str_contains($name, 'Plato') || str_contains($name, 'Menu') || str_contains($name, 'Receta') => 'PARÁMETROS',
            default => 'OTROS',
        };
    }

    private function getDescripcion($nombre): string
    {
        return match ($nombre) {
            'Gestión Total' => 'Acceso completo al módulo',
            'Lectura'  => 'Solo ver registros',
            'Adición'       => 'Crear nuevos registros',
            'Edición'       => 'Editar registros existentes',
            'Eliminación'   => 'Desactivar registros',
            default         => 'Permiso genérico',
        };
    }
}