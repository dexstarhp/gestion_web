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
        Schema::create('entrada__salidas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->float('total');
            $table->string('usuarios_id');

            $table->foreignId('entrada__salida_detalles_id')->constrained(
                table: 'entrada__salida_detalles'
            );

            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada__salidas');
    }
};
