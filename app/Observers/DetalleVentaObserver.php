<?php

namespace App\Observers;

use App\Models\DetalleVenta;
use App\Models\Inventario;

class DetalleVentaObserver
{
    /**
     * Handle the DetalleVenta "created" event.
     */
    public function created(DetalleVenta $detalle): void
    {
        $plato = $detalle->plato;
        if (!$plato) return;

        foreach ($plato->recetas as $receta) {
            $cantidadUsada = $receta->cantidad * $detalle->cantidad;

            $receta->ingrediente->decrement('cnt_actual', $cantidadUsada);

            Inventario::create([
                'producto_id' => $receta->ingrediente_id,
                'tipo' => 'venta',
                'cantidad' => $cantidadUsada,
                'fecha' => now(),
                'referencia' => $detalle->venta_id,
            ]);
        }
    }

    /**
     * Handle the DetalleVenta "updated" event.
     */
    public function updated(DetalleVenta $detalle): void
    {
        //
    }

    /**
     * Handle the DetalleVenta "deleted" event.
     */
    public function deleted(DetalleVenta $detalle): void
    {
        $plato = $detalle->plato;
        if (!$plato) return;

        foreach ($plato->recetas as $receta) {
            $cantidadDevuelta = $receta->cantidad * $detalle->cantidad;

            $receta->ingrediente->increment('cnt_actual', $cantidadDevuelta);

            Inventario::create([
                'ingrediente_id' => $receta->ingrediente_id,
                'tipo' => 'ajuste',
                'cantidad' => $cantidadDevuelta,
                'fecha' => now(),
                'referencia' => $detalle->venta_id,
            ]);
        }
    }

    /**
     * Handle the DetalleVenta "restored" event.
     */
    public function restored(DetalleVenta $detalleVenta): void
    {
        //
    }

    /**
     * Handle the DetalleVenta "force deleted" event.
     */
    public function forceDeleted(DetalleVenta $detalleVenta): void
    {
        //
    }
}
