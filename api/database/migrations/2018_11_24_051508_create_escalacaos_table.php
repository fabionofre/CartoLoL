<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscalacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escalacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invocador_id');
            $table->foreign('invocador_id')->references('id')->on('users');
            $table->unsignedInteger('meio_id');
            $table->foreign('meio_id')->references('id')->on('atletas');
            $table->unsignedInteger('topo_id');
            $table->foreign('topo_id')->references('id')->on('atletas');
            $table->unsignedInteger('cacador_id');
            $table->foreign('cacador_id')->references('id')->on('atletas');
            $table->unsignedInteger('atirador_id');
            $table->foreign('atirador_id')->references('id')->on('atletas');
            $table->unsignedInteger('suporte_id');
            $table->foreign('suporte_id')->references('id')->on('atletas');
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
        Schema::dropIfExists('escalacaos');
    }
}
