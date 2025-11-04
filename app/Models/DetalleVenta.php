<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id_dventa';
    protected $fillable = ['venta_id', 'plato_id', 'producto_id', 'cantidad', 'precio_unitario', 'subtotal'];
    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function venta() { return $this->belongsTo(Venta::class, 'venta_id', 'id_venta'); }
    public function plato() { return $this->belongsTo(Plato::class, 'plato_id', 'id_plato'); }
    public function producto() { return $this->belongsTo(Producto::class, 'producto_id', 'id_producto'); }
}
