<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atleta extends Model
{
    
	use SoftDeletes;
	
	protected $softDelete = true;

    protected $fillable = [
    	'nome', 'sobrenome','foto', 'criador_id', 'data_nascimento', 'apelido'
    ];

    public function equipe()
    {
        return $this->belongsTo('App\Atleta');
    }

}
