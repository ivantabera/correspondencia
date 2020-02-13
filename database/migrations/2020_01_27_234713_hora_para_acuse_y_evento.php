<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HoraParaAcuseYEvento extends Migration
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
            $table->timestamp('hora_acuse')->useCurrent()->after('date_acuse');
            $table->timestamp('hora_evento')->useCurrent()->after('date_evento');
            
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
            $table->dropColumn('hora_acuse');
            $table->dropColumn('hora_evento');
        });
    }
}
