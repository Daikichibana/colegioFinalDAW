<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paralelo extends Model
{
    protected $table = 'paralelo';
    protected $fillable=[
        'id',
        'nombre',
    ];
    public $timestamps=false;
}
