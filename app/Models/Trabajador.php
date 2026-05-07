<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trabajador extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'trabajadores';

    // Para Spatie y el Guard personalizado
    protected $guard_name = 'worker';

    // CONFIGURACIÓN DE CLAVE PRIMARIA (DNI no es un ID autoincremental)
    protected $primaryKey = 'dni';
    public $incrementing = false; // Indica que no es un número autoincremental
    protected $keyType = 'string'; // Indica que el DNI es una cadena

    protected $fillable = [
        'dni',
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

    protected $casts = [
        'password' => 'hashed', // Esto ayuda a que Laravel gestione el Hash
    ];
}
