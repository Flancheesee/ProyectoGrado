<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        // Creamos los roles para el guard 'worker'
        Role::create(['guard_name' => 'worker', 'name' => 'Trabajador']);
        Role::create(['guard_name' => 'worker', 'name' => 'Gestor']);
        Role::create(['guard_name' => 'worker', 'name' => 'Admin']);
    }
}
