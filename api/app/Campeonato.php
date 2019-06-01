<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Rodada;

class Campeonato extends Model
{

	use SoftDeletes;
	
	protected $softDelete = true;

    protected $fillable = [
        'titulo', 'desc', 'data_inicio', 'data_fim', 'fl_publico', 'fl_profissional', 'criador_id', 'brasao', 'equipes'
    ];

    protected $appends = ['rodada_atual', 'possui_rodada', 'primeira_rodada', 'ultima_rodada'];

    public function equipes()
    {
        // return $this->belongsToMany('App\Equipe', 'disputam_campeonato', 'equipe_id', 'campeonato_id');
    }

    public function rodadas()
    {
        return $this->hasMany('App\Rodada');
    }

    public function ligas(){
        return $this->hasMany('App\Liga');
    }

    public function getRodadaAtualAttribute(){
        $rodada = Rodada::where('id', $this->rodada_atual_id)->first(); 
        return $rodada;
    }

    public function getPossuiRodadaAttribute(){
        $rodada = Rodada::where('campeonato_id', $this->id)->first(); 
        if($rodada){
            return true;
        }

        return false;
    }

    public function getPrimeiraRodadaAttribute(){
        $rodada = Rodada::where('campeonato_id', $this->id)->orderBy('num_rodada', 'asc')->first(); 
        return $rodada;
    }

    public function getUltimaRodadaAttribute(){
        $rodada = Rodada::where('campeonato_id', $this->id)->orderBy('num_rodada', 'desc')->first(); 
        return $rodada;
    }

}
