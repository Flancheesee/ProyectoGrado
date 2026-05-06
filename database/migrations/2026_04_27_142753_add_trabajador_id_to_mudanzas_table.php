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
            $table->string('trabajador_id')->nullable()->after('user_id');
            
            $table->foreign('trabajador_id')->references('dni')->on('trabajadores')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }
    public function down(): void
    {
        Schema::table('mudanzas', function (Blueprint $table) {
            //
        });
    }
};
