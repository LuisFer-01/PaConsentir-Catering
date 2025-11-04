<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        Stock::create([
            'producto_id' => 1,
            'cnt_minima' => 10.00,
            'cnt_actual' => 50.00,
            'cnt_maxima' => 200.00
        ]);
        Stock::create([
            'producto_id' => 2,
            'cnt_minima' => 5.00,
            'cnt_actual' => 30.00,
            'cnt_maxima' => 100.00
        ]);
    }
}
