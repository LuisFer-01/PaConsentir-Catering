<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permiso', function (Blueprint $table) {
            $table->bigIncrements('id_permiso');
            $table->string('nombre', 100);
            $table->string('descripcion', 200)->nullable();
            $table->string('ruta', 150);
            $table->string('grupo', 100)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->unique(['nombre', 'descripcion', 'ruta', 'grupo'], 'unique_permiso_ruta');
        });
    }
    
    public function down(): void
        {
            Schema::table('permiso', function (Blueprint $table) {
                $table->dropUnique('unique_permiso_ruta');
            });
            Schema::dropIfExists('permiso'); 
        }
};
