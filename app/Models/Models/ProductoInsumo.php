<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoInsumo extends Model
{
    protected $table = 'productos_insumo';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = [
        'nombre', 'descripcion', 'unidad_medida_id', 'precio_compra',
        'precio_venta', 'stock_actual', 'stock_minimo'
    ];

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'unidad_medida_id');
    }

    public function categorias()
    {
        return $this->belongsToMany(CategoriaInsumo::class, 'producto_categoria', 'insumo_id', 'categoria_id');
    }

    public function recetasComoInsumo()
    {
        return $this->hasMany(Receta::class, 'insumo_id');
    }

    public function detalleCompras()
    {
        return $this->hasMany(DetalleCompra::class, 'insumo_id');
    }
}