<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DetallePermiso;
use Illuminate\Support\Facades\Route;
use Filament\Resources\Resource;

class GeneratePermissions extends Command
{
    protected $signature = 'permissions:generate';
    protected $description = 'Genera rutas de Filament Resources como permisos';

    public function handle()
    {
        $routes = Route::getRoutes();
        $filamentRoutes = [];

        foreach ($routes as $route) {
            if (str_starts_with($route->getName() ?? '', 'filament.admin.resources.')) {
                $uri = $route->uri();
                $method = $route->methods()[0] ?? 'GET';

                // Mapear acción
                $action = match (true) {
                    str_ends_with($uri, '/create') => 'Adición',
                    str_contains($uri, '/edit') => 'Edición',
                    str_contains($uri, '/{record}') && $method === 'DELETE' => 'Eliminación',
                    default => 'Solo Lectura',
                };

                $group = $this->getGroupFromUri($uri);
                $filamentRoutes[] = [
                    'ruta' => '/' . $uri,
                    'grupo' => $group,
                    'permiso' => $action,
                ];
            }
        }

        // Limpiar duplicados
        $unique = collect($filamentRoutes)->unique('ruta')->values();

        $this->info("Se encontraron {$unique->count()} rutas únicas.");

        foreach ($unique as $item) {
            $permiso = \App\Models\Permiso::firstOrCreate(
                ['nombre' => $item['permiso']],
                ['descripcion' => $item['permiso'], 'estado' => 1]
            );

            // No insertar en detalle_permiso aquí → se hace en el modal
            $this->line("Ruta: {$item['ruta']} → {$item['permiso']} ({$item['grupo']})");
        }

        $this->info('Permisos base generados.');
    }

    private function getGroupFromUri($uri)
    {
        return match (true) {
            str_contains($uri, 'users') => 'ADMINISTRACIÓN',
            str_contains($uri, 'rols') => 'ADMINISTRACIÓN',
            str_contains($uri, 'permisos') => 'ADMINISTRACIÓN',
            str_contains($uri, 'productos') => 'PARÁMETROS',
            str_contains($uri, 'platos') => 'PARÁMETROS',
            str_contains($uri, 'menus') => 'PARÁMETROS',
            str_contains($uri, 'recetas') => 'PARÁMETROS',
            str_contains($uri, 'categorias') => 'PARÁMETROS',
            str_contains($uri, 'undmedidas') => 'PARÁMETROS',
            str_contains($uri, 'tipodocumentos') => 'PARÁMETROS',
            str_contains($uri, 'tipopagos') => 'PARÁMETROS',
            str_contains($uri, 'proveedores') => 'COMPRA',
            str_contains($uri, 'compras') => 'COMPRA',
            str_contains($uri, 'clientes') => 'VENTA',
            str_contains($uri, 'ventas') => 'VENTA',
            str_contains($uri, 'pagos') => 'VENTA',
            default => 'OTROS',
        };
    }
}