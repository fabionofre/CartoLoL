<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRodadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rodadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num_rodada');
            $table->string('descricao');
            $table->unsignedInteger('campeonato_id')->nullable()->onDelete('set null');
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
        Schema::dropIfExists('rodadas');
    }
}
