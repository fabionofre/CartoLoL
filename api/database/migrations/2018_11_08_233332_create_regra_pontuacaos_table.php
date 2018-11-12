<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegraPontuacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regras_pontuacao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('acao_id')->unsigned();
            $table->integer('funcao_id')->unsigned();
            $table->integer('pontuacao')->unsigned();
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
        Schema::dropIfExists('regra_pontuacaos');
    }
}
