<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
    protected $table = 'rol_permiso';
    public $timestamps = false;
    protected $primaryKey = null; // No tiene clave primaria autoincremental
    public $incrementing = false;

    protected $fillable = ['rol_id', 'permiso_id'];

    public function rol()
    {
        return $this->belongsTo(Role::class);
    }

    public function permiso()
    {
        return $this->belongsTo(Permiso::class);
    }
}