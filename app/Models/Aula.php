<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'aula';
    protected $fillable=[
        'id',
        'descripcion',
        'capacidad',
    ];
    public $timestamps=false;
}
