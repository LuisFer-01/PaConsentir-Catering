<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    protected $table = 'producto_categoria';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = ['insumo_id', 'categoria_id'];

    public function insumo()
    {
        return $this->belongsTo(ProductoInsumo::class, 'insumo_id');
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaInsumo::class, 'categoria_id');
    }
}