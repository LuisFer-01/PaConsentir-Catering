<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class PlatoImg extends Model
{
    //use SoftDeletes;

    protected $table = 'plato_img';
    protected $primaryKey = 'id_platoimg';
    protected $fillable = ['plato_id', 'img_ruta', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function plato() { return $this->belongsTo(Plato::class, 'plato_id', 'id_plato'); }
}
