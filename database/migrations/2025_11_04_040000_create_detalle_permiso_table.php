<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_permiso', function (Blueprint $table) {
            $table->bigIncrements('id_detalle_permiso');
            $table->foreignId('permiso_id')->constrained('permiso', 'id_permiso')->onDelete('cascade');
            $table->string('ruta', 150);          // ruta del controlador o página
            $table->string('grupo', 100)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('detalle_permiso'); }
};
