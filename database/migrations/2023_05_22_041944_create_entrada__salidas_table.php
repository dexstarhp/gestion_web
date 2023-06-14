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
        Schema::create('entrada_salidas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nro');
            $table->date('fecha');
            $table->float('total');
            $table->string('usuarios_id');
            $table->enum('tipo', ['entrada', 'salida']);

            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_salidas');
    }
};
