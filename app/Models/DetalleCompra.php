<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'detalle_compras';
    protected $primaryKey = 'id_dcompra';
    protected $fillable = ['compra_id', 'producto_id', 'cantidad', 'precio_unitario', 'subtotal'];
    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function compra() { return $this->belongsTo(Compra::class, 'compra_id', 'id_compra'); }
    public function producto() { return $this->belongsTo(Producto::class, 'producto_id', 'id_producto'); }
}
