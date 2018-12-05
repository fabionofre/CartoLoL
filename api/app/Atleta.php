<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Atleta extends Model
{
    
	use SoftDeletes;
	
	protected $softDelete = true;

    protected $fillable = [
    	'nome', 'sobrenome','foto', 'criador_id', 'data_nascimento', 'apelido', 'equipe_id'
    ];

    protected $dates = [
        'created_at', 
        'updated_at', 
        'deleted_at', 
    	'data_nascimento'
    ];

    public function equipe()
    {
        return $this->belongsTo('App\Equipe');
    }

    public function pontuacoes()
    {
        return $this->hasMany('App\Pontuacao');
    }

    public function getDataNascimentoAttribute($value) {
    	return Carbon::parse($value)->diff(Carbon::now())->format('%y anos');
    }




}
