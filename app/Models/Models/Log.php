<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    protected $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'creado_en';

    protected $fillable = [
        'usuario_id', 'accion', 'tabla_afectada', 'registro_id',
        'datos_antiguos', 'datos_nuevos', 'ip_address', 'user_agent'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
