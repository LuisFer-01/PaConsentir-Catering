<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->bigIncrements('id_inventario');
            $table->foreignId('producto_id')->constrained('producto', 'id_producto')->onDelete('cascade');
            $table->enum('tipo', ['compra', 'venta', 'ajuste']);
            $table->decimal('cantidad', 10, 2);
            $table->date('fecha');
            $table->unsignedBigInteger('referencia')->nullable(); // id_compra o id_venta
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('inventario'); }
};
