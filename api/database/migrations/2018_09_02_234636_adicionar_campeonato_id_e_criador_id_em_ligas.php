<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarCampeonatoIdECriadorIdEmLigas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ligas', function (Blueprint $table) {
            $table->integer('campeonato_id')->unsigned();
            $table->foreign('campeonato_id')->references('id')->on('campeonatos');

            $table->integer('criador_id')->unsigned();
            $table->foreign('criador_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ligas', function (Blueprint $table) {
            $table->dropForeign(['campeonato_id', 'criador_id']);
            $table->dropColumn(['campeonato_id', 'criador_id']);
        });
    }
}
