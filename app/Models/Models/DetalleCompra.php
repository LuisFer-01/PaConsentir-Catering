<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'detalle_compras';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['compra_id', 'insumo_id', 'cantidad', 'precio_unitario', 'subtotal'];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function insumo()
    {
        return $this->belongsTo(ProductoInsumo::class, 'insumo_id');
    }
}
