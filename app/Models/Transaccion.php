<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $table = 'transaccion';
    protected $primaryKey = 'id_transaccion';
    protected $fillable = ['usuario_id', 'tipo', 'descripcion', 'monto', 'fecha'];
    protected $casts = [
        'monto' => 'decimal:2',
        'fecha' => 'datetime'
    ];

    public function usuario() { return $this->belongsTo(User::class, 'usuario_id'); }
}
