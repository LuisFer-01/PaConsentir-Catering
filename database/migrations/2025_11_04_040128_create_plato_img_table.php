<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plato_img', function (Blueprint $table) {
            $table->bigIncrements('id_platoimg');
            $table->foreignId('plato_id')->constrained('plato', 'id_plato')->onDelete('cascade');
            $table->string('img_ruta', 255);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('plato_img'); }
};
