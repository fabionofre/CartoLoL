<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegraPontuacao extends Model
{	

	protected $table = 'regras_pontuacao';

    protected $fillable = [
    	'acao_id', 'funcao_id', 'campeonato_id', 'pontuacao'
    ];

    public function funcoes(){
    	return $this->belongsToMany('App\Funcao'); 
    }

    public function acoes(){
    	return $this->belongsToMany('App\Acao', 'regras_pontuacao', 'id', 'acao_id');
    }

}
