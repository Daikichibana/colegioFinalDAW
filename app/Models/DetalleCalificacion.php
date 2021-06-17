<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCalificacion extends Model
{
    protected $table = 'detallecalificacion';
    protected $fillable=[
        'id',
        'notaSer',
        'notaSaber',
        'notaHacer',
        'notaDecidir',
        'codCalificacion',
        'codBimestre',
    ];
    public $timestamps=false;
}
