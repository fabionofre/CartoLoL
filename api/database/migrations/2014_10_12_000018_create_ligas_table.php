<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('desc');
            $table->unsignedInteger('campeonato_id');
            $table->foreign('campeonato_id')->references('id')->on('campeonatos');
            $table->unsignedInteger('criador_id');
            $table->foreign('criador_id')->references('id')->on('users');
            $table->string('brasao', 400)->nullable();
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
        Schema::dropIfExists('ligas');
    }
}
