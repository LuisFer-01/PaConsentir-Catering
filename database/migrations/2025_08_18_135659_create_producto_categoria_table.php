<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto_categoria', function (Blueprint $table) {
            $table->unsignedBigInteger('insumo_id');
            $table->unsignedBigInteger('categoria_id');
            $table->primary(['insumo_id', 'categoria_id']);
            $table->foreign('insumo_id')->references('id')->on('productos_insumo')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias_insumo')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto_categoria');
    }
};