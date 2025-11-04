<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Receta extends Model
{
    //use SoftDeletes;

    protected $table = 'receta';
    protected $primaryKey = 'id_receta';
    protected $fillable = ['plato_id', 'ingrediente_id', 'cantidad', 'estado'];
    protected $casts = [
        'cantidad' => 'decimal:2',
        'estado' => 'boolean'
    ];

    public function plato() { return $this->belongsTo(Plato::class, 'plato_id', 'id_plato'); }
    public function ingrediente() { return $this->belongsTo(Producto::class, 'ingrediente_id', 'id_producto'); }
}
