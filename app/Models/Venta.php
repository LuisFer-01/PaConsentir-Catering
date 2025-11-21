<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use SoftDeletes;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $fillable = ['cliente_id', 'usuario_id', 'tipodocumento_id', 'tipopago_id', 'totalprec', 'fecha', 'estado'];
    protected $casts = [
        'totalprec' => 'decimal:2',
        'fecha' => 'date',
        'estado' => 'boolean'
    ];

    public function cliente() { return $this->belongsTo(Cliente::class, 'cliente_id', 'id_cliente'); }
    public function usuario() { return $this->belongsTo(User::class, 'usuario_id'); }
    public function tipoDocumento() { return $this->belongsTo(TipoDocumento::class, 'tipodocumento_id', 'id_tipodocumento'); }
    public function detalles() { return $this->hasMany(DetalleVenta::class, 'venta_id', 'id_venta'); }
    public function tipoPago() { return $this->belongsTo(TipoPago::class, 'tipopago_id', 'id_tipopago'); }
    //public function pagos() { return $this->hasMany(Pago::class, 'venta_id', 'id_venta'); }
}
