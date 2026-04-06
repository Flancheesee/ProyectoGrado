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
        Schema::create('mudanzas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('vivienda_origen_id')->constrained('viviendas');
            $table->string('direccion_destinatario');
            $table->integer('cantidad_empleados');
            $table->integer('cantidad_vehiculos');
            $table->enum('estado', ['pendiente', 'en_curso', 'finalizada'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mudanzas');
    }
};
