<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarCampeonatoIdEmRodadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rodadas', function (Blueprint $table) {
            $table->integer('campeonato_id')->unsigned();//Cria o campo na base de dados
            $table->foreign('campeonato_id')->references('id')->on('campeonatos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rodadas', function (Blueprint $table) {
            $table->dropForeign(['campeonato_id']);
            $table->dropColumn(['campeonato_id']);
        });
    }
}
