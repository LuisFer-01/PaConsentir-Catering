<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    //use SoftDeletes;

    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    protected $fillable = ['nombre', 'apellido', 'telefono', 'email', 'direccion', 'ci', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function ventas() { return $this->hasMany(Venta::class, 'cliente_id', 'id_cliente'); }
}
