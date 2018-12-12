<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escalacao extends Model
{
    protected $table = 'escalacoes';

    protected $fillable = ['invocador_id', 'meio_id', 'topo_id', 'cacador_id', 'atirador_id','suporte_id', 'patrimonio', 'rodada_id'];

    public function topo(){
    	return $this->belongsTo('App\Atleta', 'topo_id');
    }

    public function cacador(){
    	return $this->belongsTo('App\Atleta', 'cacador_id');
    }

    public function atirador(){
    	return $this->belongsTo('App\Atleta', 'atirador_id');
    }

    public function suporte(){
    	return $this->belongsTo('App\Atleta', 'suporte_id');
    }

    public function meio(){
    	return $this->belongsTo('App\Atleta', 'meio_id');
    }

}
