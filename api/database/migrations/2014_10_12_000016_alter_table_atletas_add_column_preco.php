<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAtletasAddColumnPreco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atletas', function (Blueprint $table) {
            $table->decimal('preco', 8, 2)->default(20);
            $table->unsignedInteger('equipe_id')->nullable();
            $table->foreign('equipe_id')->references('id')->on('equipes');
            $table->unsignedInteger('funcao_id')->nullable();
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
            $table->dropColumn('preco');
            $table->dropForeign(['equipe_id']);
            $table->dropForeign(['funcao_id']);
        });
    }
}
