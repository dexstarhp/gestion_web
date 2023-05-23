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
        Schema::create('entrada__salida_detalles', function (Blueprint $table) {
            $table->id();
            $table->string('item_id');
            $table->float('cantidad');
            $table->float('precio_unitario');
            $table->string('tipo(entrada_salida)');
            $table->string('entrada_salida_cabecera_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada__salida_detalles');
    }
};
