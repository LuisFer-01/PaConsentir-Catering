<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';
    protected $primaryKey = 'id_inventario';
    protected $fillable = ['producto_id', 'tipo', 'cantidad', 'fecha', 'referencia'];
    protected $casts = [
        'cantidad' => 'decimal:2',
        'fecha' => 'date'
    ];

    public function producto() { return $this->belongsTo(Producto::class, 'producto_id', 'id_producto'); }
}
