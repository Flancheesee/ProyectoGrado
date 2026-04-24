<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Auth;
use Spatie\Permission\Traits\HasRoles;

class Trabajador extends Auth
{
    use HasRoles;
    
    protected $table = 'trabajadores';

    protected $guard_name = 'worker';

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
