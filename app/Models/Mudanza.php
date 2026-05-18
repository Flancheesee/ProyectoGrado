<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mudanza extends Model
{
    use HasFactory;

    protected $table = 'mudanzas';
    protected $primaryKey = 'mudanza_id';

    protected $fillable = [
        'user_id',
        'vivienda_origen_id',
        'direccion_destinatario',
        'cantidad_empleados',
        'matricula_vehiculo',
        'estado',
        'fecha_mudanza'
    ];

    dd($request->all());

    public function usuario() {
        return $this->belongsTo(User::class, 'mote_usuario', 'user_id');
    }

    public function origen() {
        return $this->belongsTo(Vivienda::class, 'vivienda_origen_id', 'vivienda_id');
    }

    public function destino() {
        return $this->belongsTo(Vivienda::class, 'Vivienda_destino', 'id_vivienda');
    }

    public function conductor(){
        return $this->belongsTo(Trabajador::class, 'trabajador_id', 'dni');
    }

    public function estado(){
        return $this->estado;
    }
}