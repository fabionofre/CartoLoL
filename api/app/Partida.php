<?php

namespace App;
use App\Equipe;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{

	protected $appends = ['timea', 'timeb'];

	public function rodada(){
		return $this->belongsTo('App\Rodada');
	}

	public function timea(){
		return $this->belongsTo('App\Equipe');
	}

	public function timeb(){
		return $this->belongsTo('App\Equipe');
	}

    public function getTimeaAttribute(){
    	$timea = Equipe::find($this->timea_id);
        return $timea;
    }

    public function getTimebAttribute(){
    	$timeb = Equipe::find($this->timeb_id);
        return $timeb;
    }

}
