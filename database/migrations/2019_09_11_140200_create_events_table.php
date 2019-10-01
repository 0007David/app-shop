<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->dateTime('date'); //fecha - hora
            $table->string('address');  //direccion
            $table->string('latitude'); //latitud
            $table->string('length'); //longitud
            $table->float('total_amount'); //monto total -> productos
            $table->float('transport_cost')->default(0.0); // costo de transporte
            $table->float('additional_amount')->default(0.0); // costo adicional
            $table->string('state')->default('Revision');

            //Foreign Key to CARRITO
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->foreign('cart_id')->references('id')->on('carts');

            //Foreign Key to CALIFICACION
            $table->unsignedBigInteger('score_id')->nullable();
            $table->foreign('score_id')->references('id')->on('scores');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
