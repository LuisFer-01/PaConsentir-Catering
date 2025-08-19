<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = [
        'proveedor_id', 'documento_id', 'numero_documento', 'fecha', 'subtotal',
        'descuento', 'total', 'observaciones', 'usuario_id', 'pdf_ruta'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'compra_id');
    }
}