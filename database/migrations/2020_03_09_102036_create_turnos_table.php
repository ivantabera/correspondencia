<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('folio');
            $table->string('fecha_turno');
            $table->unsignedBigInteger('turnado_ccp');
            $table->unsignedBigInteger('turnado_por');
            $table->string('intruccion_adicional');
            $table->unsignedBigInteger('instrucciones');
            $table->string('semaforo');
            $table->string('respuesta_auto');
            $table->string('compromiso');
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
        Schema::dropIfExists('turnos');
    }
}
