<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plato', function (Blueprint $table) {
            $table->bigIncrements('id_plato');
            $table->string('nombre', 150);
            $table->string('descripcion', 300)->nullable();
            $table->decimal('precio', 10, 2);
            $table->foreignId('menu_id')->nullable()->constrained('menu', 'id_menu')->onDelete('set null');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('plato'); }
};
