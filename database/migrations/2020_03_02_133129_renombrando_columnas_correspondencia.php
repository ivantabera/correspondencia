<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenombrandoColumnasCorrespondencia extends Migration
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
            $table->renameColumn('promotor', 'promoremit_id');
            $table->renameColumn('remitente', 'remitente_id');
            $table->renameColumn('dirigido', 'dirigido_id');
            $table->renameColumn('tipo', 'tipo_id');
            $table->renameColumn('expediente', 'expediente_id');
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
            $table->dropColumn('promoremit_id');
            $table->dropColumn('remitente_id');
            $table->dropColumn('dirigido_id');
            $table->dropColumn('tipo_id');
            $table->dropColumn('expediente_id');
        });
    }
}
