<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

//use Illuminate\Database\Eloquent\SoftDeletes;

class DetallePermiso extends Model
{
    //use SoftDeletes;
    use HasFactory;

    protected $table = 'detalle_permiso';
    protected $primaryKey = 'id_detalle_permiso';
    protected $fillable = ['rol_id','permiso_id', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function rol(): BelongsTo { return $this->belongsTo(Rol::class, 'rol_id', 'id_rol'); }
    public function permiso(): BelongsTo { return $this->belongsTo(Permiso::class, 'permiso_id', 'id_permiso'); }
}
