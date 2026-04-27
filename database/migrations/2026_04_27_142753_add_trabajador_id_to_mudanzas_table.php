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
        Schema::table('mudanzas', function (Blueprint $table) {
            // La columna para el ID del trabajador (que sea nullable porque al principio no tiene nadie)
            $table->unsignedBigInteger('trabajador_id')->nullable()->after('user_id');
            $table->foreign('trabajador_id')->references('trabajador_id')->on('trabajadores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mudanzas', function (Blueprint $table) {
            //
        });
    }
};
