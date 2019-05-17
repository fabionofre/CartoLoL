<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAtletasAddColumnFuncaoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atletas', function (Blueprint $table) {
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
            $table->dropColumn('funcao_id');
        });
    }
}
