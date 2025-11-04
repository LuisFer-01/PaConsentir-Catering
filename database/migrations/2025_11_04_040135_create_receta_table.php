<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('receta', function (Blueprint $table) {
            $table->bigIncrements('id_receta');
            $table->foreignId('plato_id')->constrained('plato', 'id_plato')->onDelete('cascade');
            $table->foreignId('ingrediente_id')->constrained('producto', 'id_producto')->onDelete('cascade');
            $table->decimal('cantidad', 10, 2);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('receta'); }
};
