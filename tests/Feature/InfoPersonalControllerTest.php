<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Egresado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InfoPersonalControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para verificar que el método index carga la vista con datos correctos.
     */
    public function testIndex()
    {
        // Crear un usuario autenticado
        $user = User::factory()->create(['name' => 'Carlos Pérez']);
        $this->actingAs($user); // Usar actingAs para autenticación

        // Crear un egresado asociado a este usuario
        $egresado = Egresado::factory()->create([
            'user_id' => $user->id,
            'numero_identificacion' => '1020304050',
        ]);

        // Hacer una petición GET a la ruta del index
        $response = $this->get(route('infopersonal'));

        // Verificar que la vista correcta se carga
        $response->assertStatus(200);
        $response->assertViewIs('arca.infopersonal');

        // Verificar que los datos del usuario y egresado estén presentes
        $response->assertViewHas('user', $user);
        $response->assertViewHas('egresado', $egresado);
    }

    /**
     * Test para verificar que la actualización de la información funciona correctamente.
     */
    public function testUpdate()
    {
        // Crear un usuario autenticado
        $user = User::factory()->create(['name' => 'María López']);
        $this->actingAs($user); // Usar actingAs para autenticación

        // Crear un egresado asociado a este usuario
        $egresado = Egresado::factory()->create([
            'user_id' => $user->id,
        ]);

        // Datos para la actualización
        $data = [
            'numero_identificacion' => '555123456',
            'direccion' => 'Calle Nueva 789',
            'telefono' => '3124567890',
            'programa_academico' => 'Medicina',
            'fecha_inicio_pregrado' => '2017-02-01',
            'fecha_fin_pregrado' => '2022-11-30',
            'user_id' => $user->id,
        ];

        // Hacer una petición POST para actualizar la información
        $response = $this->post(route('infopersonal.store'), $data);

        // Verificar que el egresado fue actualizado correctamente
        $egresado->refresh();
        $this->assertEquals($data['numero_identificacion'], $egresado->numero_identificacion);
        $this->assertEquals($data['direccion'], $egresado->direccion);

        // Verificar el mensaje de éxito
        $response->assertSessionHas('success', 'Información actualizada correctamente.');
        // Asegurarse de que la redirección sea correcta
        $response->assertRedirect(route('infopersonal'));
    }

    /**
     * Test para verificar que la creación de la información funciona correctamente.
     */
    public function testCreate()
    {
        // Crear un usuario autenticado
        $user = User::factory()->create(['name' => 'Jorge Ramírez']);
        $this->actingAs($user); // Usar actingAs para autenticación

        // Datos para crear un nuevo egresado
        $data = [
            'numero_identificacion' => '789456123',
            'direccion' => 'Avenida Central 101',
            'telefono' => '3169876543',
            'programa_academico' => 'Contaduría Pública',
            'fecha_inicio_pregrado' => '2018-01-15',
            'fecha_fin_pregrado' => '2023-06-20',
            'user_id' => $user->id,
        ];

        // Hacer una petición POST para crear la información
        $response = $this->post(route('infopersonal.store'), $data);

        // Verificar que se creó un nuevo egresado en la base de datos
        $this->assertDatabaseHas('egresados', [
            'numero_identificacion' => $data['numero_identificacion'],
            'direccion' => $data['direccion'],
            'telefono' => $data['telefono'],
        ]);

        // Verificar el mensaje de éxito
        $response->assertSessionHas('success', 'Información registrada exitosamente.');
        // Asegurarse de que la redirección sea correcta
        $response->assertRedirect(route('infopersonal'));
    }
}
