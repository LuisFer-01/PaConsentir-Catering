<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

//use Illuminate\Database\Eloquent\SoftDeletes;

class Permiso extends Model
{
    //use SoftDeletes;
    use HasFactory;

    protected $table = 'permiso';
    protected $primaryKey = 'id_permiso';
    protected $fillable = ['nombre', 'descripcion', 'ruta', 'grupo',  'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function detalles(): HasMany { return $this->hasMany(DetallePermiso::class, 'permiso_id', 'id_permiso'); }
}
