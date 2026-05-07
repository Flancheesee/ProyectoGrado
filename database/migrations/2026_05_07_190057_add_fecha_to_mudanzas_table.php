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
            $table->date('fecha_mudanza')->nullable()->after('matricula_vehiculo');
        });
    }

    public function down(): void
    {
        Schema::table('mudanzas', function (Blueprint $table) {
            $table->dropColumn('fecha_mudanza');
        });
    }
};
