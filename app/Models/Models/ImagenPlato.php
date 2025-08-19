<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenPlato extends Model
{
    protected $table = 'imagenes_platos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'creado_en';

    protected $fillable = ['plato_id', 'imagen_ruta', 'es_principal'];

    public function plato()
    {
        return $this->belongsTo(Plato::class);
    }
}