<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPivotTableParticipantesLiga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes_liga', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invocador_id');
            $table->foreign('invocador_id')->references('id')->on('users');
            $table->unsignedInteger('liga_id');
            $table->foreign('liga_id')->references('id')->on('ligas');
            $table->unique(['liga_id', 'invocador_id']);
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
        Schema::dropIfExists('participantes_liga');
    }
}
