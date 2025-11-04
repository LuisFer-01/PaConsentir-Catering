<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    //use SoftDeletes;

    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $fillable = ['nombre', 'descripcion', 'fecha_inicio', 'fecha_fin', 'estado'];
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'estado' => 'boolean'
    ];

    public function platos() { return $this->hasMany(Plato::class, 'menu_id', 'id_menu'); }
}
