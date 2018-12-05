<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePontuacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pontuacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade');
            $table->unsignedInteger('atleta_id');
            $table->foreign('atleta_id')->references('id')->on('atletas');            
            $table->unsignedInteger('acao_id');
            $table->foreign('acao_id')->references('id')->on('acoes');
            $table->unsignedInteger('rodada_id');
            $table->foreign('rodada_id')->references('id')->on('rodadas');
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
        Schema::dropIfExists('pontuacoes');
    }
}
