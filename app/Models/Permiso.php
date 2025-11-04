<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Permiso extends Model
{
    //use SoftDeletes;

    protected $table = 'permiso';
    protected $primaryKey = 'id_permiso';
    protected $fillable = ['nombre', 'descripcion', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function detalles() { return $this->hasMany(DetallePermiso::class, 'permiso_id', 'id_permiso'); }
}
