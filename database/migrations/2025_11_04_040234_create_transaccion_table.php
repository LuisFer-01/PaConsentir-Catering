<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaccion', function (Blueprint $table) {
            $table->bigIncrements('id_transaccion');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('restrict');
            $table->string('tipo', 50); // COMPRA, VENTA, AJUSTE, etc.
            $table->string('descripcion', 300);
            $table->decimal('monto', 12, 2);
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('transaccion'); }
};
