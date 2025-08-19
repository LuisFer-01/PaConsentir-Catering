<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPlato extends Model
{
    protected $table = 'menu_plato';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = ['menu_id', 'plato_id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function plato()
    {
        return $this->belongsTo(Plato::class);
    }
}