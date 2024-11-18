<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    // Atributos que se permiten para la asignación masiva
    protected $fillable = [
        'titulo',
        'autor',
        'estado',
    ];
}
