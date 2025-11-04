<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->bigIncrements('id_stock');
            $table->foreignId('producto_id')->constrained('producto', 'id_producto')->onDelete('cascade');
            $table->decimal('cnt_minima', 10, 2)->default(0);
            $table->decimal('cnt_actual', 10, 2)->default(0);
            $table->decimal('cnt_maxima', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('stock'); }
};
