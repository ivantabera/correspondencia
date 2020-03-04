<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearForeingParaCamposCorrespondencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('captura_correspondencias', function (Blueprint $table) {
            $table->foreign('dirigido_id')->references('id')->on('dirigidos');
            $table->foreign('tipo_id')->references('id')->on('tipodocs');
            $table->foreign('expediente_id')->references('id')->on('expedientes');
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
        Schema::table('captura_correspondencias', function (Blueprint $table) {
            $table->dropForeign('dirigido_id');
            $table->dropForeign('tipo_id');
            $table->dropForeign('expediente_id');
        });
    }
}
