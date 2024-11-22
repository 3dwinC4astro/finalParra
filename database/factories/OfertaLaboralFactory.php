<?php

namespace Database\Factories;

use App\Models\OfertaLaboral;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfertaLaboralFactory extends Factory
{
    protected $model = OfertaLaboral::class;

    public function definition()
    {
        return [
            'cargo' => $this->faker->jobTitle,
            'descripcion' => $this->faker->paragraph,
            'requisitos' => $this->faker->text,
            'nombre_empresa' => $this->faker->company,
            'contacto_empresa' => $this->faker->name,
            'correo_empresa' => $this->faker->companyEmail,
            'ciudad_empresa' => $this->faker->city,
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
            'user_id' => \App\Models\User::factory(), // Asumiendo que tienes un modelo User y quieres asociarlo con una oferta
        ];
    }
}
