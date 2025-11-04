<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    //use SoftDeletes;

    protected $table = 'pago';
    protected $primaryKey = 'id_pago';
    protected $fillable = ['venta_id', 'tipopago_id', 'monto', 'fecha_pago', 'estado'];
    protected $casts = [
        'monto' => 'decimal:2',
        'fecha_pago' => 'date',
        'estado' => 'boolean'
    ];

    public function venta() { return $this->belongsTo(Venta::class, 'venta_id', 'id_venta'); }
    public function tipoPago() { return $this->belongsTo(TipoPago::class, 'tipopago_id', 'id_tipopago'); }
}
