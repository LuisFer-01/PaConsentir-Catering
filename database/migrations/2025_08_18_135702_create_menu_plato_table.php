<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_plato', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('plato_id');
            $table->primary(['menu_id', 'plato_id']);
            $table->foreign('menu_id')->references('id')->on('menús')->onDelete('cascade');
            $table->foreign('plato_id')->references('id')->on('platos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_plato');
    }
};