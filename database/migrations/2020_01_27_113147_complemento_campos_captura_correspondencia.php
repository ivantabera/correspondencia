<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ComplementoCamposCapturaCorrespondencia extends Migration
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
            $table->string('num_entrada', 250)->nullable()->after('id');
            $table->timestamp('date_acuse')->useCurrent()->after('num_entrada');
            $table->timestamp('date_elaboracion')->useCurrent()->after('date_acuse');
            $table->string('antecedente', 250)->nullable()->after('dirigido');
            $table->string('firmado_por', 250)->nullable()->after('particular');
            $table->string('cargo', 250)->nullable()->after('firmado_por');
            $table->string('tipo', 250)->nullable()->after('cargo');
            $table->string('expediente', 250)->nullable()->after('tipo');
            $table->string('clasificacion', 250)->nullable()->after('expediente');
            $table->string('evento', 250)->nullable()->after('asunto');
            $table->string('date_evento')->useCurrent()->after('evento');
            $table->string('prioridad', 250)->nullable()->after('date_evento');
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
            $table->dropColumn('date_acuse');
            $table->dropColumn('date_elaboracion');
            $table->dropColumn('antecedente');
            $table->dropColumn('particular');
            $table->dropColumn('firmado_por');
            $table->dropColumn('cargo');
            $table->dropColumn('tipo');
            $table->dropColumn('expediente');
            $table->dropColumn('clasificacion');
            $table->dropColumn('evento');
            $table->dropColumn('date_evento');
            $table->dropColumn('prioridad');
        });
    }
}
