<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearCampoNumEntrada extends Migration
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
            $table->unsignedBigInteger('num_entrada')->after('user_id');
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
            $table->dropColumn('num_entrada');
        });
    }
}
