<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampeonatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campeonatos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 45);
            $table->string('desc', 60);
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->unsignedInteger('criador_id');
            $table->foreign('criador_id')->references('id')->on('users');
            $table->boolean('fl_publico');
            $table->boolean('fl_profissional');
            $table->string('brasao', 300);
            $table->enum('estado', ['em_criacao', 'em_andamento', 'finalizado'])->default('em_criacao');
            $table->softDeletes();
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
        Schema::dropIfExists('campeonatos');
    }
}
