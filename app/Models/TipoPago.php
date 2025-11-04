<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPago extends Model
{
    //use SoftDeletes;

    protected $table = 'tipopago';
    protected $primaryKey = 'id_tipopago';
    protected $fillable = ['nombre', 'descripcion', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function compras() { return $this->hasMany(Compra::class, 'tipopago_id', 'id_tipopago'); }
    public function pagos() { return $this->hasMany(Pago::class, 'tipopago_id', 'id_tipopago'); }
}
