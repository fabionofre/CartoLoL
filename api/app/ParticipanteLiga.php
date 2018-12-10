<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipanteLiga extends Model
{
    protected $table = 'participantes_liga';

    protected $fillable = ['liga_id', 'invocador_id'];


}
