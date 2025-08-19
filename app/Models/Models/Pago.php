<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'creado_en';

    protected $fillable = ['venta_id', 'fecha', 'monto', 'metodo', 'referencia', 'observaciones', 'tipo'];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
