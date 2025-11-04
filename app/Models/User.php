<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    // use SoftDeletes
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'password', 'phone', 'ci', 'address', 'photo', 'rol_id', 'estado'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'estado' => 'boolean'
    ];
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function rol() { return $this->belongsTo(Rol::class, 'rol_id', 'id_rol'); }
    public function compras() { return $this->hasMany(Compra::class, 'usuario_id'); }
    public function ventas() { return $this->hasMany(Venta::class, 'usuario_id'); }
    public function historialPrecios() { return $this->hasMany(HprProducto::class, 'usuario_id'); }
    public function transacciones() { return $this->hasMany(Transaccion::class, 'usuario_id'); }
}
