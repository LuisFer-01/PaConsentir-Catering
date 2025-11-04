<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HprProducto extends Model
{
    protected $table = 'hprproducto';
    protected $primaryKey = 'id_hpr';
    protected $fillable = ['producto_id', 'precio_anterior', 'precio_nuevo', 'fecha_cambio', 'usuario_id'];
    protected $casts = [
        'precio_anterior' => 'decimal:2',
        'precio_nuevo' => 'decimal:2',
        'fecha_cambio' => 'datetime'
    ];

    public function producto() { return $this->belongsTo(Producto::class, 'producto_id', 'id_producto'); }
    public function usuario() { return $this->belongsTo(User::class, 'usuario_id'); }
}
