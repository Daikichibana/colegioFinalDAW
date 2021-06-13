<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripcion';
    protected $fillable=[
        'id',
        'fecha',
        'codACursoGestion',
        'codEstudiante'
    ];
    public $timestamps=false;
}
