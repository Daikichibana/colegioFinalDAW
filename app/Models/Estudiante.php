<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiante';
    protected $fillable=[
        'id',
        'nombre',
        'apellido',
        'telefono',
        'fechaNacimiento',
        'direccion',
        'idUsuario',
    ];
    public $timestamps=false;
}
