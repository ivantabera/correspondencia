<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambioTipoDatosANullable extends Migration
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
            $table->string('referencia')->nullable()->change();
            $table->string('promotor')->nullable()->change();
            $table->string('remitente')->nullable()->change();
            $table->string('dirigido')->nullable()->change();
            $table->string('particular')->nullable()->change();
            $table->text('asunto')->nullable()->change();
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
            $table->dropColumn('referencia');
            $table->dropColumn('promotor');
            $table->dropColumn('remitente');
            $table->dropColumn('dirigido');
            $table->dropColumn('particular');
            $table->dropColumn('asunto');
        });
    }
}
