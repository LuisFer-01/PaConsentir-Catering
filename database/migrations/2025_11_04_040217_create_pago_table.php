<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pago', function (Blueprint $table) {
            $table->bigIncrements('id_pago');
            $table->foreignId('venta_id')->constrained('ventas', 'id_venta')->onDelete('cascade');
            $table->foreignId('tipopago_id')->constrained('tipopago', 'id_tipopago')->onDelete('restrict');
            $table->decimal('monto', 12, 2);
            $table->date('fecha_pago');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('pago'); }
};
