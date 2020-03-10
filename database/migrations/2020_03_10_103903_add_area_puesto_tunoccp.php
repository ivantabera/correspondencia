<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAreaPuestoTunoccp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('turnadoccps', function (Blueprint $table) {
            $table->string('area')->after('alias');
            $table->string('puesto')->after('nombre');
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
        Schema::table('turnadoccps', function (Blueprint $table) {
            $table->dropColumn('area');
            $table->dropColumn('puesto');
        });
    }
}
