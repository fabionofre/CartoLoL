<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipe extends Model
{
    
	use SoftDeletes;
	
	protected $softDelete = true;

    protected $fillable = [
    	'nome', 'brasao','fl_profissional', 'criador_id', 'atletas'
    ];

    public function campeonatos()
    {
        return $this->belongsToMany('App\Campeonato', 'disputam_campeonato', 'campeonato_id', 'equipe_id');
    }

    public function atletas()
    {
        return $this->hasMany('App\Atleta');
    }

}
