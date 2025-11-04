<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class UndMedida extends Model
{
    //use SoftDeletes;

    protected $table = 'undmedida';
    protected $primaryKey = 'id_undmedida';
    protected $fillable = ['nombre', 'descripcion', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function productos() { return $this->hasMany(Producto::class, 'undmedida_id', 'id_undmedida'); }
}
