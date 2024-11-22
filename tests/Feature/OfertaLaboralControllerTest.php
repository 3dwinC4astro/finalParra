<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\OfertaLaboral;
use App\Models\User;

class OfertaLaboralControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_muestra_ofertas_laborales()
    {
        // Crea un usuario para simular autenticación
        $user = User::factory()->create();

        // Crea ofertas laborales en la base de datos
        OfertaLaboral::factory()->count(3)->create();

        // Simula una solicitud como usuario autenticado
        $response = $this->actingAs($user)->get(route('ofertas.index'));

        // Verifica que la vista contenga las ofertas laborales
        $response->assertStatus(200);
        $response->assertViewHas('ofertas');
        $response->assertViewIs('ofertas.index');
    }

    public function test_create_muestra_vista_de_creacion()
    {
        // Crea un usuario para simular autenticación
        $user = User::factory()->create();

        // Simula una solicitud para ver la vista de crear oferta
        $response = $this->actingAs($user)->get(route('ofertas.create'));

        // Verifica que la vista de crear oferta se muestre correctamente
        $response->assertStatus(200);
        $response->assertViewIs('ofertas.create');
    }

    public function test_store_guarda_oferta_laboral_correctamente()
    {
        // Crea un usuario para simular autenticación
        $user = User::factory()->create();

        // Datos de ejemplo para la prueba
        $data = [
            'cargo' => 'Desarrollador Web',
            'descripcion' => 'Responsable de desarrollar aplicaciones web.',
            'requisitos' => 'Experiencia en PHP, Laravel, JavaScript.',
            'nombre_empresa' => 'Techwin Solutions',
            'contacto_empresa' => 'Juan Pérez',
            'correo_empresa' => 'contacto@techwin.com',
            'ciudad_empresa' => 'Bogotá',
            'estado' => 'activo',
        ];

        // Simula una solicitud como usuario autenticado
        $response = $this->actingAs($user)->post(route('ofertas.store'), $data);

        // Verifica que la oferta laboral se haya guardado en la base de datos
        $this->assertDatabaseHas('ofertas_laborales', [
            'cargo' => 'Desarrollador Web',
            'nombre_empresa' => 'Techwin Solutions',
        ]);

        // Verifica que la respuesta sea un redireccionamiento exitoso
        $response->assertStatus(302); // Redirección tras guardar
        $response->assertRedirect(route('ofertas.index'));
    }

    public function test_update_actualiza_oferta_laboral_correctamente()
    {
        // Crea un usuario para simular autenticación
        $user = User::factory()->create();

        // Crea una oferta laboral existente
        $oferta = OfertaLaboral::factory()->create();

        // Datos de ejemplo para la actualización
        $data = [
            'cargo' => 'Desarrollador Full Stack',
            'descripcion' => 'Responsable de aplicaciones web y móviles.',
            'requisitos' => 'Experiencia en Laravel, Vue.js, y MongoDB.',
            'nombre_empresa' => 'Techwin Solutions',
            'contacto_empresa' => 'Ana López',
            'correo_empresa' => 'contacto@techwin.com',
            'ciudad_empresa' => 'Medellín',
            'estado' => 'activo',
        ];

        // Simula una solicitud de actualización como usuario autenticado
        $response = $this->actingAs($user)->put(route('ofertas.update', $oferta), $data);

        // Verifica que los datos de la oferta hayan sido actualizados en la base de datos
        $this->assertDatabaseHas('ofertas_laborales', [
            'cargo' => 'Desarrollador Full Stack',
            'nombre_empresa' => 'Techwin Solutions',
        ]);

        // Verifica que la respuesta sea un redireccionamiento exitoso
        $response->assertStatus(302); // Redirección tras actualización
        $response->assertRedirect(route('ofertas.index'));
    }

    public function test_activar_cambia_estado_a_activo()
    {
        // Crea un usuario para simular autenticación
        $user = User::factory()->create();

        // Crea una oferta laboral inactiva
        $oferta = OfertaLaboral::factory()->create(['estado' => 'inactivo']);

        // Simula una solicitud para activar la oferta
        $response = $this->actingAs($user)->patch(route('ofertas.activate', $oferta->id));

        // Verifica que el estado de la oferta haya cambiado a 'activo'
        $this->assertDatabaseHas('ofertas_laborales', [
            'id' => $oferta->id,
            'estado' => 'activo',
        ]);

        // Verifica que la respuesta sea un redireccionamiento exitoso
        $response->assertStatus(302); // Redirección tras activar
        $response->assertRedirect(route('ofertas.index'));
    }

    public function test_inactivar_cambia_estado_a_inactivo()
    {
        // Crea un usuario para simular autenticación
        $user = User::factory()->create();

        // Crea una oferta laboral activa
        $oferta = OfertaLaboral::factory()->create(['estado' => 'activo']);

        // Simula una solicitud para inactivar la oferta
        $response = $this->actingAs($user)->patch(route('ofertas.inactivate', $oferta->id));

        // Verifica que el estado de la oferta haya cambiado a 'inactivo'
        $this->assertDatabaseHas('ofertas_laborales', [
            'id' => $oferta->id,
            'estado' => 'inactivo',
        ]);

        // Verifica que la respuesta sea un redireccionamiento exitoso
        $response->assertStatus(302); // Redirección tras inactivar
        $response->assertRedirect(route('ofertas.index'));
    }
}
