<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionCursoGestion extends Model
{
    protected $table = 'asignaciongestioncurso';
    protected $fillable=[
        'id',
        'codCurso',
        'codGestion',
        'codParalelo',
    ];
    public $timestamps=false;
}
