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
        Schema::create('detañlles__ventas', function (Blueprint $table) {
            $table->id();
            $table->string('productos_id');
            $table->string('cantidad');
            $table->string('precio_unitario');
            $table->string('importe');
            $table->string('ventas_id');
            $table->string('tipo(producto, servicio)');
            $table->timestamps();

            $table->foreignId('productos_id')->constrained(
                table: 'productos'
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
        Schema::dropIfExists('detañlles__ventas');
    }
};
