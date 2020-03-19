<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AceptarDatosNulos extends Migration
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
            $table->unsignedBigInteger('turno_num')->nullable()->change();
            $table->string('ccp')->nullable()->change();
            $table->string('instruccion_adicional')->nullable()->change();
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
            $table->dropColumn('turno_num');
            $table->dropColumn('ccp');
            $table->dropColumn('instruccion_adicional');
        });
    }
}
