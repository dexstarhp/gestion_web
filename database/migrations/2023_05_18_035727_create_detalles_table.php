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
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();
            // llave foranea (forean key)
            $table->foreignId('item_id')->constrained(
                table: 'items'
            );
            // 1234567,12
            $table->float('cantidad', 7, 2);
            $table->float('precio_unitario',7,2);
            $table->foreignId('factura_recibo_id')->constrained(
                table: 'factura_recibos'
            );

            $table->foreignId('destino_id')->constrained(
                table: 'destinos'
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
        Schema::dropIfExists('detalles');
    }
};
