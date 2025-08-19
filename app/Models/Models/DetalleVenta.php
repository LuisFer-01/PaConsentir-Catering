<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_ventas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'venta_id', 'plato_id', 'menu_id', 'cantidad',
        'precio_unitario', 'subtotal', 'modificaciones'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function plato()
    {
        return $this->belongsTo(Plato::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
