<?php

namespace Database\Factories;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Contraseña por defecto
            'remember_token' => Str::random(10),
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
        ];
    }

    // Método para crear usuarios con roles específicos
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Aquí asignas un rol al usuario creado
            $role = Role::firstOrCreate(['name' => 'usuario']); // Cambia 'usuario' por el rol que quieras
            $user->assignRole($role);
        });
    }
}
