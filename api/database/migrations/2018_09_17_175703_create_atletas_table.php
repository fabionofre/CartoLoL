<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atletas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 60);
            $table->string('apelido', 60);
            $table->string('sobrenome', 120);
            $table->date('data_nascimento');
            $table->unsignedInteger('criador_id');
            $table->foreign('criador_id')->references('id')->on('users');
            $table->unsignedInteger('equipe_id')->nullable();
            $table->foreign('equipe_id')->references('id')->on('equipes')->onDelete('set null');
            // $table->unsignedInteger('funcao_id')->nullable();
            // $table->foreign('funcao_id')->references('id')->on('funcoes');
            $table->string('foto', 300);
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
        Schema::dropIfExists('atletas');
    }
}
