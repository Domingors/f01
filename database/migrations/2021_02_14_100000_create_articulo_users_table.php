<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticuloUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->require;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('articulo_id')->require;
            $table->foreign('articulo_id')->references('id')->on('articulos')->onDelete('cascade');
            //$table->unique('user_id','articulo_id');
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
        Schema::dropIfExists('articulo_users');
    }
}
