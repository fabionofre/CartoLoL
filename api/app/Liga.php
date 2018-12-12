<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{

    protected $fillable = ['liga_id', 'invocador_id'];
    
    public function participantes()
    {
        return $this->belongsToMany('App\User', 'participantes_liga', 'liga_id', 'invocador_id');
    }

    public function campeonato(){
    	return $this->belongsTo('App\Campeonato');
    }

    public function criador(){
    	return $this->belongsTo('App\User', 'criador_id');
    }


}
