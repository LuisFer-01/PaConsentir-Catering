<?php

namespace Database\Seeders;

use App\Models\ProductoImg;
use Illuminate\Database\Seeder;

class ProductoImgSeeder extends Seeder
{
    public function run(): void
    {
        ProductoImg::create([
            'producto_id' => 1,
            'img_ruta' => 'productos/arroz.jpg',
            'estado' => 1
        ]);
    }
}
