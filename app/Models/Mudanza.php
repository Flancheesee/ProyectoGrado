<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mudanza extends Model
{
    use HasFactory;

    protected $table = 'MUDANZA';
    protected $primaryKey = 'ID_mudanza';

    protected $fillable = [
        'num_empleados',
        'num_vehiculos',
        'Vivienda_origen',
        'Vivienda_destino',
        'mote_usuario'
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'mote_usuario', 'user_id');
    }

    // Relación con Vivienda de Origen
    public function origen()
    {
        return $this->belongsTo(Vivienda::class, 'Vivienda_origen', 'ID_VIVIENDA');
    }

    // Relación con Vivienda de Destino
    public function destino()
    {
        return $this->belongsTo(Vivienda::class, 'Vivienda_destino', 'ID_VIVIENDA');
    }
}