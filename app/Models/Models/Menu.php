<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menús';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = ['nombre', 'descripcion', 'precio_total'];

    public function platos()
    {
        return $this->belongsToMany(Plato::class, 'menu_plato', 'menu_id', 'plato_id');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'menu_id');
    }

    public function detalleCotizaciones()
    {
        return $this->hasMany(DetalleCotizacion::class, 'menu_id');
    }
}