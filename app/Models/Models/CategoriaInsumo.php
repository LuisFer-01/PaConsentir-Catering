<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaInsumo extends Model
{
    protected $table = 'categorias_insumo';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = ['nombre'];

    public function productos()
    {
        return $this->belongsToMany(ProductoInsumo::class, 'producto_categoria', 'categoria_id', 'insumo_id');
    }
}