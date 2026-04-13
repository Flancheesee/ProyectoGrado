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
            Schema::create('conductores', function (Blueprint $table) {
                $table->string('dni_empleado')->primary();
                
                $table->foreign('dni_empleado')
                    ->references('dni')
                    ->on('trabajadores')
                    ->onDelete('cascade');

                $table->string('matricula_vehiculo')->nullable(); 
                $table->foreign('matricula_vehiculo')
                    ->references('matricula')
                    ->on('vehiculos')
                    ->onDelete('set null');

                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conductores');
    }
};