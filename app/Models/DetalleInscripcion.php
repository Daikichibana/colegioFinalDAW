<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleInscripcion extends Model
{
    protected $table = 'detalleInscripcion';
    protected $fillable=[
        'codApoderado',
        'codInscripcion',
        'relacion'
    ];
    public $timestamps=false;
}
