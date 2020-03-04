<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearCamposCorrespondenciaParaForeing extends Migration
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
            $table->unsignedBigInteger('dirigido_id')->after('remitente_id');
            $table->unsignedBigInteger('tipo_id')->after('cargo');
            $table->unsignedBigInteger('expediente_id')->after('tipo_id');
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
            $table->dropColumn('dirigido_id');
            $table->dropColumn('tipo_id');
            $table->dropColumn('expediente_id');
        });
    }
}
