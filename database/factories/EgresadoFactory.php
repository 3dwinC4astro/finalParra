<?php

namespace Database\Factories;

use App\Models\Egresado;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EgresadoFactory extends Factory
{
    protected $model = Egresado::class;

    public function definition()
    {
        return [
            'numero_identificacion' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
            'programa_academico' => 'Ingeniería de Sistemas',
            'fecha_inicio_pregrado' => $this->faker->date(),
            'fecha_fin_pregrado' => $this->faker->date(),
            'user_id' => User::factory(),
        ];
    }
}
