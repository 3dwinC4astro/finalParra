<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crear los roles sin asignarles permisos
        Role::firstOrCreate(['name' => 'administrador']);
        Role::firstOrCreate(['name' => 'director']);
        Role::firstOrCreate(['name' => 'docente']);
        Role::firstOrCreate(['name' => 'egresado']);
    }
}
