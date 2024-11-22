<?php
// database/factories/InfoPersonalFactory.php
namespace Database\Factories;

use App\Models\InfoPersonal;
use Illuminate\Database\Eloquent\Factories\Factory;

class InfoPersonalFactory extends Factory
{
    protected $model = InfoPersonal::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'direccion' => $this->faker->address(),
            'telefono' => $this->faker->phoneNumber(),
        ];
    }
}
