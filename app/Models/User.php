<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable{

    use HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'mote',
        'name',
        'apellidos',
        'email',
        'telefono',
        'foto_perfil',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Esto encripta automáticamente al guardar
    ];

    public function mudanzas()
    {
        return $this->hasMany(Mudanza::class, 'mote_usuario', 'user_id');
    }
}
