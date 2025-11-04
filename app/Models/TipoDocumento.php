<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDocumento extends Model
{
    //use SoftDeletes;

    protected $table = 'tipodocumento';
    protected $primaryKey = 'id_tipodocumento';
    protected $fillable = ['nombre', 'descripcion', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function compras() { return $this->hasMany(Compra::class, 'tipodocumento_id', 'id_tipodocumento'); }
    public function ventas() { return $this->hasMany(Venta::class, 'tipodocumento_id', 'id_tipodocumento'); }
}
