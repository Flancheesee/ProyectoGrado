<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mudanza extends Model
{
    use HasFactory;

    protected $table = 'mudanza';
    protected $primaryKey = 'mudanza_id';

    protected $fillable = [
        'user_id',
        'vivienda_origen_id',
        'direccion_destinatario',
        'cantidad_empleados',
        'cantidad_vehiculos',
        'estado'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'mote_usuario', 'user_id');
    }

    public function origen() {
        return $this->belongsTo(Vivienda::class, 'Vivienda_origen', 'ID_VIVIENDA');
    }

    public function destino() {
        return $this->belongsTo(Vivienda::class, 'Vivienda_destino', 'ID_VIVIENDA');
    }
}