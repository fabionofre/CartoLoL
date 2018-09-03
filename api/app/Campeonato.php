<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{

    protected $fillable = [
        'titulo', 'desc', 'data_inicio', 'data_fim', 'fl_publico', 'fl_profissional', 'criador_id', 'brasao'
    ];

}
