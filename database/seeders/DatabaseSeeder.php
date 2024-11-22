<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Llama al seeder de roles y permisos
        $this->call(RolesAndPermissionsSeeder::class);

        // Crea un usuario y le asigna el rol de administrador
        $admin = User::create([
            'imagen' => 'https://green.excertia.com/wp-content/uploads/2020/04/perfil-empty.png',
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456789'), // Cambia esto por una contraseña segura
        ]);

        // Asigna el rol de administrador
        $admin->assignRole('administrador');

        
    }
}
