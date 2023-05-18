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
        Schema::create('factura_recibos', function (Blueprint $table) {
            $table->id();
            $table->integer('nro');
            $table->date('fecha');
            $table->float('total',8,2);
            //llaves foraneas
            // $table->unsigned('proveedor_id');
            // $table->foreign('proveedor_id')->references('id')->on('proveedores');

            // $table->unsigned('user_id');
            // $table->foreign('user_id')->references('id')->on('users');

            //segunda manera
            // $table->foreignId('proveedor_id')->constrained();
            // proeedor_id proveedors
            // provider_id providers
            // laravel buscara el nombre de la tabla en plural y lo relacionara

            $table->foreignId('proveedor_id')->constrained(
                table: 'proveedores'
            );

            // $table->foreignId('user_id')->constrained(
            //     table: 'users', indexName: 'factura_recibos_user_id'
            // );

            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_recibos');
    }
};
