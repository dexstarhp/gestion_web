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
        Schema::create('entrada_salida_detalles', function (Blueprint $table) {
            $table->id();
            $table->string('item_id');
            $table->float('cantidad');
            $table->float('precio_unitario');
            $table->foreignId('entrada_salida_id')->constrained(
                table: 'entrada_salidas'
            );

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_salida_detalles');
    }
};
