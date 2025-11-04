<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    //use SoftDeletes;

    protected $table = 'rol';
    protected $primaryKey = 'id_rol';
    protected $fillable = ['nombre', 'descripcion', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function users() { return $this->hasMany(User::class, 'rol_id', 'id_rol'); }
    public function detallePermisos() { return $this->hasMany(Rol::class, 'rol_id', 'id_rol'); }
}
