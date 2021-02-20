<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('l_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id')->require;
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            $table->unsignedBigInteger('articuloUser_id')->require;
            $table->foreign('articuloUser_id')->references('id')->on('articulo_users')->onDelete('cascade');
            //$table ->unique('pedido_id','articuloUser_id');
            $table->string('codigo', 10);
            $table->string('descripcion',50);
            $table->integer('cantidad')->default('1');
            $table->decimal('precio',8,2)->default('1.00');
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
        Schema::dropIfExists('l_pedidos');
    }
}
