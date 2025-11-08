<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = $request->user();
        if (!$user || !$user->rol) {
            abort(403);
        }

        $hasPermission = $user->rol->detallePermiso()
            ->where('estado', 1)
            ->where('ruta', $request->route()->uri())
            ->whereHas('permiso', fn($q) => $q->where('nombre', $this->mapPermission($permission)))
            ->exists();

        if (!$hasPermission && $user->rol->id_rol != 1) {
            abort(403, 'Acceso denegado.');
        }

        return $next($request);
    }

    private function mapPermission($action)
    {
        return match ($action) {
            'viewAny', 'view' => 'Lectura',
            'create' => 'Adición',
            'update' => 'Edición',
            'delete' => 'Eliminación',
            default => 'Gestión Total',
        };
    }
}
