<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePensamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pensamientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');

            //registro para saber a que usuario pertenece cada pensamiento 
            //(unsignedBigInteger) se usa porque el id de la tabla es de tipo bigIncrements
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('pensamientos');
    }
}
