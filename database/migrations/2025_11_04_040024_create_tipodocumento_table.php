<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipodocumento', function (Blueprint $table) {
            $table->bigIncrements('id_tipodocumento');
            $table->string('nombre', 80);      // Factura, Boleta, etc.
            $table->string('descripcion', 150)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('tipodocumento'); }
};
