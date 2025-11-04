<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->bigIncrements('id_producto');
            $table->string('nombre', 150);
            $table->string('descripcion', 300)->nullable();
            $table->decimal('precio', 10, 2);
            $table->foreignId('categoria_id')->constrained('categoria', 'id_categoria')->onDelete('restrict');
            $table->foreignId('undmedida_id')->constrained('undmedida', 'id_undmedida')->onDelete('restrict');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('producto'); }
};
