<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vivienda extends Model
{
    use HasFactory;

    protected $table = 'vivienda';
    protected $primaryKey = 'vivienda_id';


    protected $fillable = [
        'user_id',
        'nombre',
        'tipo',
        'direccion'
    ];

    public function mudanzas()
    {
        // Una vivienda puede estar en muchas mudanzas
        return $this->hasMany(Mudanza::class, 'Vivienda_origen', 'ID_VIVIENDA');
    }
}