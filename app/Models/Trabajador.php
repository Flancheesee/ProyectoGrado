<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table = 'trabajadores';

    protected $primaryKey = 'dni';

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'sueldo',
        'rol',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
