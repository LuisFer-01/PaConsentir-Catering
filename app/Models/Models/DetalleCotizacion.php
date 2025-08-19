<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCotizacion extends Model
{
    protected $table = 'detalle_cotizaciones';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'cotizacion_id', 'plato_id', 'menu_id', 'cantidad',
        'precio_unitario', 'subtotal', 'modificaciones'
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    public function plato()
    {
        return $this->belongsTo(Plato::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
