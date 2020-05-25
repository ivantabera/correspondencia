<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBajaTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baja_turnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idBaja');
            $table->string('fechSalida');
            $table->string('fechBaja');
            $table->string('distribuyo');
            $table->string('ots');
            $table->string('dirigido');
            $table->string('acuseSellos');
            $table->string('observac');
            $table->string('exp');
            $table->string('nomArch');
            $table->timestamps();

            $table->foreign('idBaja')->references('id')->on('captura_correspondencias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baja_turnos');
    }
}
