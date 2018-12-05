<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pontuacao extends Model
{
    protected $table = 'pontuacoes';

    public function atleta()
    {
        return $this->belongsTo('App\Atleta');
    }

    public function rodada()
    {
        return $this->belongsTo('App\Rodada');
    }

}
