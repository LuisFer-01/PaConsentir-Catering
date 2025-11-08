<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    //use SoftDeletes;
    use HasFactory;

    protected $table = 'rol';
    protected $primaryKey = 'id_rol';
    protected $fillable = ['nombre', 'descripcion', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function users(): HasMany { return $this->hasMany(User::class, 'rol_id', 'id_rol'); }
    public function detallePermisos(): HasMany { return $this->hasMany(DetallePermiso::class, 'rol_id', 'id_rol'); }
}
