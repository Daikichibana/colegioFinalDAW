<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimestre extends Model
{
    protected $table = 'bimestre';
    protected $fillable=[
        'id',
        'bimestre',
    ];
    public $timestamps=false;
}
