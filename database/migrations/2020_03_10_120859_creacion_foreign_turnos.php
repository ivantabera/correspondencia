<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreacionForeignTurnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('turnos', function (Blueprint $table) {
            $table->foreign('folio')->references('id')->on('captura_correspondencias');
            $table->foreign('turnado_a')->references('id')->on('turnadoccps');
            $table->foreign('ccp')->references('id')->on('turnadoccps');
            $table->foreign('turnado_por')->references('id')->on('turnadopors');
            $table->foreign('instruccion')->references('id')->on('instruccions');
            $table->foreign('semaforo')->references('id')->on('semaforos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('turnos', function (Blueprint $table) {
            $table->dropForeign('folio');
            $table->dropForeign('turnado_a');
            $table->dropForeign('ccp');
            $table->dropForeign('turnado_por');
            $table->dropForeign('instruccion');
            $table->dropForeign('semaforo');
        });
    }
}
