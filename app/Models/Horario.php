<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario';
    protected $fillable=[
        'id',
        'horaInicio',
        'horaFinalizacion',
        'dia',
        'codTurno',
    ];
    public $timestamps=false;
}