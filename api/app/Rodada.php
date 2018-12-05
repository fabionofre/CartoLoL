<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rodada extends Model
{

    public function equipe()
    {
        return $this->belongsTo('App\Campeonato');
    }

    public function pontuacoes()
    {
        return $this->hasMany('App\Pontuacao');
    }
}
