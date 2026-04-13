<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('viviendas', function (Blueprint $table) {
        $table->id('vivienda_id');
        $table->foreignId('user_id')
          ->constrained('users', 'user_id') // <--- AQUÍ: (tabla, columna_en_esa_tabla)
          ->onDelete('cascade');
        $table->string('nombre'); 
        $table->string('tipo');
        $table->string('direccion');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viviendas');
    }
};
