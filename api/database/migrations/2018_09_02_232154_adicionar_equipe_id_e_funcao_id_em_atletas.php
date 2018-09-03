<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdicionarEquipeIdEFuncaoIdEmAtletas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atletas', function (Blueprint $table) {
            $table->integer('equipe_id')->unsigned();
            $table->foreign('equipe_id')->references('id')->on('equipes');

            $table->integer('funcao_id')->unsigned();
            $table->foreign('funcao_id')->references('id')->on('funcoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atletas', function (Blueprint $table) {
            $table->dropForeign(['equipe_id', 'funcao_id']);
            $table->dropColumn(['equipe_id', 'funcao_id']);
        });
    }
}
