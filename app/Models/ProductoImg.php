<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ProductoImg extends Model
{
    //use SoftDeletes;

    protected $table = 'producto_img';
    protected $primaryKey = 'id_pimg';
    protected $fillable = ['producto_id', 'img_ruta', 'estado'];
    protected $casts = ['estado' => 'boolean'];

    public function producto() { return $this->belongsTo(Producto::class, 'producto_id', 'id_producto'); }
}
