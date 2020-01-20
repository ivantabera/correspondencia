<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoremitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promoremits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alias')->nullable();
            $table->string('nombre')->nullable();
            $table->string('encargado')->nullable();
            $table->string('cargo')->nullable();
            $table->string('tipo')->nullable();
            $table->string('extension')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promoremits');
    }
}
