<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plato_id');
            $table->unsignedBigInteger('insumo_id');
            $table->decimal('cantidad', 10, 2);
            $table->string('unidad', 20);
            $table->timestamps();

            $table->unique(['plato_id', 'insumo_id']);
            $table->foreign('plato_id')->references('id')->on('platos')->onDelete('cascade');
            $table->foreign('insumo_id')->references('id')->on('productos_insumo')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recetas');
    }
};