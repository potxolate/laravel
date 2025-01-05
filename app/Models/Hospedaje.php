<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospedaje extends Model
{
    use HasFactory;
    protected $table = 'hospedaje';

    protected $fillable = [
        'nombre',
        'tipo',
        'ubicacion',        
    ];
}
