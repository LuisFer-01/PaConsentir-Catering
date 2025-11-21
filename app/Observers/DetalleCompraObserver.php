<?php

namespace App\Observers;

use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Inventario;

class DetalleCompraObserver
{
    /**
     * Handle the DetalleCompra "created" event.
     */
    public function created(DetalleCompra $detalle): void
    {
        $producto = Producto::find($detalle->producto_id);
        $producto->increment('cnt_actual', $detalle->cantidad);

        Inventario::create([
            'producto_id' => $detalle->producto_id,
            'tipo' => 'compra',
            'cantidad' => $detalle->cantidad,
            'fecha' => now(),
            'referencia' => $detalle->compra_id,
        ]);
    }

    /**
     * Handle the DetalleCompra "updated" event.
     */
    public function updated(DetalleCompra $detalle): void
    {
        $diferencia = $detalle->getOriginal('cantidad') - $detalle->cantidad;
        $producto = Producto::find($detalle->producto_id);
        $producto->decrement('cnt_actual', abs($diferencia));

        Inventario::create([
            'producto_id' => $detalle->producto_id,
            'tipo' => 'ajuste',
            'cantidad' => -$diferencia,
            'fecha' => now(),
            'referencia' => $detalle->compra_id,
        ]);
    }

    /**
     * Handle the DetalleCompra "deleted" event.
     */
    public function deleted(DetalleCompra $detalle): void
    {
        $producto = Producto::find($detalle->producto_id);
        $producto->decrement('cnt_actual', $detalle->cantidad);

        Inventario::create([
            'producto_id' => $detalle->producto_id,
            'tipo' => 'ajuste',
            'cantidad' => -$detalle->cantidad,
            'fecha' => now(),
            'referencia' => $detalle->compra_id,
        ]);
    }

    /**
     * Handle the DetalleCompra "restored" event.
     */
    public function restored(DetalleCompra $detalleCompra): void
    {
        //
    }

    /**
     * Handle the DetalleCompra "force deleted" event.
     */
    public function forceDeleted(DetalleCompra $detalleCompra): void
    {
        //
    }
}
