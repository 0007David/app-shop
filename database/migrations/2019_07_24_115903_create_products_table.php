<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { //PROUCTO(id,nombre,descripcion,descripcion__larga, precio_base,cantidad_base, stock, Stock_ocupado,categoria_id)
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name',150);
            $table->string('description',200);
            $table->text('long_description')->nullable();
            $table->float('price'); //precio_base 
            $table->integer('base_quantity')->nullable(); //cantidad_base 
            //nuevos atributos
            $table->bigInteger('stock')->nullable();  //cantidad total del producto
            $table->bigInteger('busy_stock')->nullable(); //cantidad prestada en un servicio

            //Foreign Key
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');


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
        Schema::dropIfExists('products');
    }
}
