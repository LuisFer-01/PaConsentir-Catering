<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Rol;
use App\Models\Permiso;
use App\Observers\RolObserver;
use App\Observers\PermisoObserver;
use App\Models\DetalleCompra;
use App\Observers\DetalleCompraObserver;
use App\Models\DetalleVenta;
use App\Observers\DetalleVentaObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Rol::observe(RolObserver::class);
        Permiso::observe(PermisoObserver::class);
        DetalleCompra::observe(DetalleCompraObserver::class);
        DetalleVenta::observe(DetalleVentaObserver::class);
    }
}
