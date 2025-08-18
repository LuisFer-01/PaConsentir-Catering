<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('plato_id')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->decimal('cantidad', 10, 2);
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 12, 2);
            $table->text('modificaciones')->nullable();
            $table->timestamps();

            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreign('plato_id')->references('id')->on('platos')->onDelete('set null');
            $table->foreign('menu_id')->references('id')->on('menús')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};