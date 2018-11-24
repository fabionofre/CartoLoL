<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escalacao extends Model
{
    protected $table = 'escalacoes';

    protected $fillable = ['invocador_id', 'meio_id', 'topo_id', 'cacador_id', 'atirador_id','suporte_id'];

}
