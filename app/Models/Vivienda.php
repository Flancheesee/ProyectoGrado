<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vivienda extends Model
{
    use HasFactory;

    protected $table = 'VIVIENDA';
    protected $primaryKey = 'ID_VIVIENDA';

    protected $fillable = [
        'Direccion',
        'Nombre',
        'Tipo'
    ];

    // Relación: Una vivienda puede estar en muchas mudanzas (como origen o destino)
    public function mudanzasOrigen()
    {
        return $this->hasMany(Mudanza::class, 'Vivienda_origen', 'ID_VIVIENDA');
    }

    public function mudanzasDestino()
    {
        return $this->hasMany(Mudanza::class, 'Vivienda_destino', 'ID_VIVIENDA');
    }
}