<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->bigIncrements('id_dventa');
            $table->foreignId('venta_id')->constrained('ventas', 'id_venta')->onDelete('cascade');
            $table->foreignId('plato_id')->nullable()->constrained('plato', 'id_plato')->onDelete('set null');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('detalle_venta'); }
};
