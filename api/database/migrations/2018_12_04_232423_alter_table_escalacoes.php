<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableEscalacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escalacoes', function (Blueprint $table) {
            $table->unsignedInteger('rodada_id')->default(1);
            $table->foreign('rodada_id')->references('id')->on('rodadas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escalacoes', function (Blueprint $table) {
            $table->dropForeign(['rodada_id']);
        });
    }
}
