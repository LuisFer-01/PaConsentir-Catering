<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto_img', function (Blueprint $table) {
            $table->bigIncrements('id_pimg');
            $table->foreignId('producto_id')->constrained('producto', 'id_producto')->onDelete('cascade');
            $table->string('img_ruta', 255);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('producto_img'); }
};
