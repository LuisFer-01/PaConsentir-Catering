<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    //use SoftDeletes;

    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['nombre', 'descripcion', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function productos() { return $this->hasMany(Producto::class, 'categoria_id', 'id_categoria'); }
}
