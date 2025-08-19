<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = [
        'nombre', 'contacto', 'telefono', 'correo', 'direccion', 'estado'
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}