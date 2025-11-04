<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('undmedida', function (Blueprint $table) {
            $table->bigIncrements('id_undmedida');
            $table->string('nombre', 50);
            $table->string('descripcion', 150)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('undmedida'); }
};
