<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar claves foráneas para limpiar la tabla con seguridad
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Vehiculo::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $vehiculos = [
            [
                'matricula' => '1111-AAA',
                'nombre'    => 'Vehiculo 1',
                'modelo'    => 'Camión pequeño',
            ],
            [
                'matricula' => '2222-BBB',
                'nombre'    => 'Vehiculo 2',
                'modelo'    => 'Camión mediano',
            ],
            [
                'matricula' => '3333-CCC',
                'nombre'    => 'Vehiculo 3',
                'modelo'    => 'Camión grande',
            ],
            [
                'matricula' => '4444-DDD',
                'nombre'    => 'Vehiculo 4',
                'modelo'    => 'Trailer',
            ],
        ];

        foreach ($vehiculos as $vehiculo) {
            Vehiculo::create($vehiculo);
        }
    }
}