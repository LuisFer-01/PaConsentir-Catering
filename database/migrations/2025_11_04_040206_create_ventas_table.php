<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id_venta');
            $table->foreignId('cliente_id')->nullable()->constrained('cliente', 'id_cliente')->onDelete('set null');
            $table->foreignId('usuario_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('tipodocumento_id')->constrained('tipodocumento', 'id_tipodocumento')->onDelete('restrict');
            $table->foreignId('tipopago_id')->constrained('tipopago', 'id_tipopago')->onDelete('restrict');
            $table->decimal('totalprec', 12, 2);
            $table->date('fecha');
            $table->boolean('estado')->default(1); // 1=completado, 0=pendiente/cancelado
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('ventas'); }
};
