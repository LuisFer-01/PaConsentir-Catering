<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Plato extends Model
{
    //use SoftDeletes;

    protected $table = 'plato';
    protected $primaryKey = 'id_plato';
    protected $fillable = ['nombre', 'descripcion', 'precio', 'menu_id', 'estado'];
    protected $casts = [
        'precio' => 'decimal:2',
        'estado' => 'boolean'
    ];

    public function menu() { return $this->belongsTo(Menu::class, 'menu_id', 'id_menu'); }
    public function imagenes() { return $this->hasMany(PlatoImg::class, 'plato_id', 'id_plato'); }
    public function recetas() { return $this->hasMany(Receta::class, 'plato_id', 'id_plato'); }
    public function detallesVenta() { return $this->hasMany(DetalleVenta::class, 'plato_id', 'id_plato'); }
}
