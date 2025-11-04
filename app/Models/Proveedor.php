<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    //use SoftDeletes;

    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';
    protected $fillable = ['nombre', 'contacto', 'telefono', 'email', 'direccion', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function compras() { return $this->hasMany(Compra::class, 'proveedor_id', 'id_proveedor'); }
}
