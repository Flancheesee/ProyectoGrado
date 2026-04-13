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
        Schema::create('asignaciones_mudanza', function (Blueprint $table) {
            $table->id('asignacion_id');

            $table->unsignedBigInteger('id_mudanza');
            $table->foreign('id_mudanza')
                  ->references('mudanza_id')
                  ->on('mudanzas')
                  ->onDelete('cascade');

            $table->string('dni_empleado');
            $table->foreign('dni_empleado')
                  ->references('dni')
                  ->on('trabajadores')
                  ->onDelete('cascade');

            $table->string('matricula');
            $table->foreign('matricula')
                  ->references('matricula')
                  ->on('vehiculos')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones_mudanza');
    }
};