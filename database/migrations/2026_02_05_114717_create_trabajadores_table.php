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
            Schema::create('trabajadores', function (Blueprint $table) {
                // Usamos string porque un DNI no es un número autoincremental
                $table->string('dni')->primary(); 
                $table->string('nombre');
                $table->string('apellidos');
                $table->string('telefono');
                $table->decimal('sueldo', 8, 2);
                $table->enum('rol', ['conductor', 'peon']);
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};
