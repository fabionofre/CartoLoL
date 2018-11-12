<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    protected $table = 'funcoes';

    public function acoes()
    {
        return $this->belongsToMany('App\Acao', 'regras_pontuacao', 'acao_id', 'funcao_id');
    }

    public function regrasPontuacao(){
    	return $this->belongsToMany('App\RegraPontuacao');
    }
    
}
