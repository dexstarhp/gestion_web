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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();

            $table->float('cantidad',7,2);
            $table->float('precio_unitario',7,2);
            $table->float('importe',7,2);

            $table->foreignId('venta_id')->constrained(
                table: 'ventas');

            $table->enum('tipo', ['producto', 'servicio']);
            $table->foreignId('item_id')->constrained(
                table: 'items');
                
            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
