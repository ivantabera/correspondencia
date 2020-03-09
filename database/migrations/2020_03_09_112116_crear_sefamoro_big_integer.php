<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearSefamoroBigInteger extends Migration
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
            $table->unsignedBigInteger('semaforo')->after('instrucciones');
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
            $table->dropColumn('semaforo');
        });
    }
}
