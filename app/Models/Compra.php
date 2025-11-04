<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    //use SoftDeletes;

    protected $table = 'compra';
    protected $primaryKey = 'id_compra';
    protected $fillable = ['proveedor_id', 'usuario_id', 'tipodocumento_id', 'tipopago_id', 'totalcost', 'fecha', 'estado'];
    protected $casts = [
        'totalcost' => 'decimal:2',
        'fecha' => 'date',
        'estado' => 'boolean'
    ];

    public function proveedor() { return $this->belongsTo(Proveedor::class, 'proveedor_id', 'id_proveedor'); }
    public function usuario() { return $this->belongsTo(User::class, 'usuario_id'); }
    public function tipoDocumento() { return $this->belongsTo(TipoDocumento::class, 'tipodocumento_id', 'id_tipodocumento'); }
    public function tipoPago() { return $this->belongsTo(TipoPago::class, 'tipopago_id', 'id_tipopago'); }
    public function detalles() { return $this->hasMany(DetalleCompra::class, 'compra_id', 'id_compra'); }
}
