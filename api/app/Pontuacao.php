<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pontuacao extends Model
{
    protected $table = 'pontuacoes';

    // protected $appends = ['atleta'];
    // public function getAtletaAttribute(){
    // 	$atleta = Atleta::find($this->atleta_id)->first();
    // 	return $atleta;
    // }

    // public function getRodadaObjAttribute(){
    // 	$rodada = Rodada::find($this->rodada_id)->first();
    // 	return $rodada;
    // }

    // public function getAcaoObjAttribute(){
    // 	$acao = Acao::find($this->acao_id)->first();
    // 	return $acao;
    // }

    public function atleta()
    {
        return $this->belongsTo('App\Atleta');
    }

    public function rodada()
    {
        return $this->belongsTo('App\Rodada');
    }

    public function acao()
    {
        return $this->belongsTo('App\Acao');
    }

}
