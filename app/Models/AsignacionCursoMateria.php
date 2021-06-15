<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionCursoMateria extends Model
{
    protected $table = 'asignacionmateriacurso';
    protected $fillable=[
        'id',
        'codMateria',
        'codCursoGestion',
        'codDocente',
    ];
    public $timestamps=false;
}
