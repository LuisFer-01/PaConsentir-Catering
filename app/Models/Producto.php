<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    //use SoftDeletes;

    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    protected $fillable = ['nombre', 'descripcion', 'precio', 'categoria_id', 'undmedida_id', 'img_ruta', 'estado'];
    protected $casts = [
        'precio' => 'decimal:2',
        'estado' => 'boolean'
    ];

    public function categoria() { return $this->belongsTo(Categoria::class, 'categoria_id', 'id_categoria'); }
    public function undmedida() { return $this->belongsTo(UndMedida::class, 'undmedida_id', 'id_undmedida'); }
    //public function imagenes() { return $this->hasMany(ProductoImg::class, 'producto_id', 'id_producto'); }
    public function stock() { return $this->hasOne(Stock::class, 'producto_id', 'id_producto'); }
    public function recetas() { return $this->hasMany(Receta::class, 'ingrediente_id', 'id_producto'); }
    public function detallesCompra() { return $this->hasMany(DetalleCompra::class, 'producto_id', 'id_producto'); }
    public function detallesVenta() { return $this->hasMany(DetalleVenta::class, 'producto_id', 'id_producto'); }
    public function historialPrecios() { return $this->hasMany(HprProducto::class, 'producto_id', 'id_producto'); }
    public function inventarios() { return $this->hasMany(Inventario::class, 'producto_id', 'id_producto'); }
}
