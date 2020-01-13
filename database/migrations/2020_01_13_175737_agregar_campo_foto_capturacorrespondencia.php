<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarCampoFotoCapturacorrespondencia extends Migration
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
            $table->string('foto', 250)->nullable()->after('asunto');
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
            $table->dropColumn('foto');
        });
    }
}
