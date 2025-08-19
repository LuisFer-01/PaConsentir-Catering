<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $table = 'recetas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = ['plato_id', 'insumo_id', 'cantidad', 'unidad'];

    public function plato()
    {
        return $this->belongsTo(Plato::class);
    }

    public function insumo()
    {
        return $this->belongsTo(ProductoInsumo::class, 'insumo_id');
    }
}