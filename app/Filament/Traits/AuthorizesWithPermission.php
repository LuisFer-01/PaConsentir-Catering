<?php

namespace App\Filament\Traits;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Filament\Facades\Filament;

trait AuthorizesWithPermission
{
    public static function canViewAny(): bool
    {
        return static::hasPermission('viewAny');
    }

    public static function canCreate(): bool
    {
        return static::hasPermission('create');
    }

    public static function canView($record): bool
    {
        return static::hasPermission('view', $record);
    }

    public static function canEdit($record): bool
    {
        return static::hasPermission('update', $record);
    }

    public static function canDelete($record): bool
    {
        return static::hasPermission('delete', $record);
    }

    protected static function hasPermission(string $action, $record = null): bool
    {
        // Usar Filament Auth (funciona en contexto estático)
        $user = Filament::auth()->user();

        if (!$user || !$user->rol) {
            return false;
        }

        // Admin siempre tiene acceso
        if ($user->rol->id_rol == 1) {
            return true;
        }

        $uri = '/' . ltrim(Request::path(), '/');
        if (str_ends_with($uri, '/create')) {
            $uri = dirname($uri);
        }

        $permissionName = match ($action) {
            'viewAny', 'view' => 'Lectura',
            'create' => 'Adición',
            'update' => 'Edición',
            'delete' => 'Eliminación',
            default => null,
        };

        if (!$permissionName) return false;

        return $user->rol->detallePermiso()
            ->where('estado', 1)
            ->whereHas('permiso', function ($q) use ($permissionName, $uri) {
                $q->where('nombre', $permissionName)
                  ->where(function ($query) use ($uri) {
                      $query->where('ruta', $uri)
                            ->orWhere('ruta', "$uri/*");
                  });
            })
            ->exists();
    }
}