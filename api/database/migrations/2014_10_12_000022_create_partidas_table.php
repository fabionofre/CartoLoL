<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rodada_id');
            $table->foreign('rodada_id')->references('id')->on('rodadas');

            $table->integer('timea_id')->unsigned();
            $table->foreign('timea_id')->references('id')->on('equipes'); 

            $table->integer('timeb_id')->unsigned();
            $table->foreign('timeb_id')->references('id')->on('equipes');

            $table->unsignedInteger('resultado_partida_id')->nullable();
            $table->foreign('resultado_partida_id')->references('id')->on('resultado_partidas');

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
        Schema::dropIfExists('partidas');
    }
}
