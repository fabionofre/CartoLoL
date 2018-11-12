<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acao extends Model
{
	protected $table = 'acoes';

    public function funcoes()
    {
        return $this->belongsToMany('App\Funcao', 'regras_pontuacao', 'funcao_id', 'acao_id');
    }

    public function regrasPontuacao(){
    	return $this->belongsToMany('App\RegraPontuacao');
    }

}
