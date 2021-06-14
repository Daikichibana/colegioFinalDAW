<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionCursoEstudiante extends Model
{
    protected $table = 'asignacionestudiantecurso';
    protected $fillable=[
        'id',
        'codEstudiante',
        'codMateriaCurso',
    ];
    public $timestamps=false;
}
