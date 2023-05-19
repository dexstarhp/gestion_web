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
            $table->string('item_id');
            $table->string('cantidad');
            $table->float('precio_unitario');
            $table->string('factura_recibo_id');
            $table->string('destino:id');
            $table->timestamps();

            $table->foreignId('destinos')->constrained(
                table: 'destinos'
            );
            $table->foreignId('items')->constrained(
                table: 'items'
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
