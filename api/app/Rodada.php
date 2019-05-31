<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rodada extends Model
{

    use SoftDeletes;

    protected $softDelete = true;

    public function campeonato()
    {
        return $this->belongsTo('App\Campeonato');
    }

    public function pontuacoes()
    {
        return $this->hasMany('App\Pontuacao');
    }

    public function partidas()
    {
        return $this->hasMany('App\Partida');
    }

}
