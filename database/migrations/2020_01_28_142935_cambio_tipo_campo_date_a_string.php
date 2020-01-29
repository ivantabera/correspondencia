<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambioTipoCampoDateAString extends Migration
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
            $table->string('date_acuse')->change();
            $table->string('date_elaboracion')->change();
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
            $table->dropColumn('date_acuse');
            $table->dropColumn('date_elaboracion');
        });
    }
}
