<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';
    protected $primaryKey = 'id_stock';
    protected $fillable = ['producto_id', 'cnt_minima', 'cnt_actual', 'cnt_maxima'];
    protected $casts = [
        'cnt_minima' => 'decimal:2',
        'cnt_actual' => 'decimal:2',
        'cnt_maxima' => 'decimal:2'
    ];

    public function producto() { return $this->belongsTo(Producto::class, 'producto_id', 'id_producto'); }
}
