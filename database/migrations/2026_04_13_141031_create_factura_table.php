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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('id_factura');
            
            $table->decimal('precio', 10, 2);
            $table->decimal('iva', 10, 2);
            $table->decimal('total', 10, 2);
            
            $table->string('metodo'); // Tarjeta, PayPal, Transferencia...
            $table->enum('estado', ['Completado', 'Pendiente', 'Fallido'])->default('Pendiente');
            
            $table->unsignedBigInteger('id_mudanza');
            $table->foreign('id_mudanza')
                  ->references('mudanza_id')
                  ->on('mudanzas')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};