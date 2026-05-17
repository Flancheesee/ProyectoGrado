<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peones_mudanza', function (Blueprint $table) {
            $table->foreignId('mudanza_id')->constrained('mudanzas', 'mudanza_id')->onDelete('cascade');

            $table->string('dni'); 
            
            $table->foreign('dni')
                  ->references('dni') 
                  ->on('trabajadores')
                  ->onDelete('cascade');

            $table->primary(['mudanza_id', 'dni']);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peones_mudanza');
    }
};
