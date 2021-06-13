<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docente';
    protected $fillable=[
        'id',
        'nombre',
        'apellido',
        'telefono',
        'idUsuario',
    ];
    public $timestamps=false;
}
