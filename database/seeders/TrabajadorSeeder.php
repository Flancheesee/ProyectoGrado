<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trabajador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TrabajadorSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivamos checks para limpiar la tabla
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Trabajador::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. El Conductor (Rol permitido: 'conductor')
        Trabajador::create([
            'dni'       => '12345678A',
            'nombre'    => 'Juan',
            'apellidos' => 'Pérez Conductor',
            'telefono'  => '600111222',
            'sueldo'    => 1400.50,
            'rol'       => 'conductor', 
            'password'  => Hash::make('123456'),
        ]);

        // 2. El Administrativo (Cambiado de 'administrativo' a 'admin')
        Trabajador::create([
            'dni'       => '87654321B',
            'nombre'    => 'Ana',
            'apellidos' => 'García Admin',
            'telefono'  => '611222333',
            'sueldo'    => 1600.00,
            'rol'       => 'admin',
            'password'  => Hash::make('123456'),
        ]);

        // 3. El Peón (Rol permitido: 'peon')
        Trabajador::create([
            'dni'       => '11223344C',
            'nombre'    => 'Marta',
            'apellidos' => 'Sánchez Peón',
            'telefono'  => '622333444',
            'sueldo'    => 1200.00,
            'rol'       => 'peon', 
            'password'  => Hash::make('123456'),
        ]);
    }
}
