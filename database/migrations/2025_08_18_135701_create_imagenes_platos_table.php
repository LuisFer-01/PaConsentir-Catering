<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imagenes_platos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plato_id');
            $table->string('imagen_ruta', 500);
            $table->boolean('es_principal')->default(false);
            $table->timestamps();

            $table->foreign('plato_id')->references('id')->on('platos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagenes_platos');
    }
};