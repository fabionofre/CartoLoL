<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campeonato extends Model
{

	use SoftDeletes;
	
	protected $softDelete = true;

    protected $fillable = [
        'titulo', 'desc', 'data_inicio', 'data_fim', 'fl_publico', 'fl_profissional', 'criador_id', 'brasao', 'equipes'
    ];

    public function equipes()
    {
        return $this->belongsToMany('App\Equipe', 'disputam_campeonato', 'equipe_id', 'campeonato_id');
    }

    public function rodadas()
    {
        return $this->hasMany('App\Rodada');
    }

    public function ligas(){
        return $this->hasMany('App\Liga');
    }

}
