<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    protected $table = 'platos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = ['nombre', 'descripcion', 'precio_venta', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(CategoriaPlato::class, 'categoria_id');
    }

    public function recetas()
    {
        return $this->hasMany(Receta::class, 'plato_id');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenPlato::class, 'plato_id');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_plato', 'plato_id', 'menu_id');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'plato_id');
    }

    public function detalleCotizaciones()
    {
        return $this->hasMany(DetalleCotizacion::class, 'plato_id');
    }
}