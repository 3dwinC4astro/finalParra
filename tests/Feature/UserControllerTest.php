<?php

namespace Tests\Feature;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexMuestraUsuariosYRoles()
    {
        // Crear un usuario para simular autenticación
        $user = User::factory()->create();

        // Crear roles
        $adminRole = Role::create(['name' => 'administrador']);
        $editorRole = Role::create(['name' => 'editor']);

        // Asignar roles al usuario
        $user->assignRole($adminRole);

        // Simula una solicitud como usuario autenticado
        $response = $this->actingAs($user)->get(route('users.index'));

        // Asegurarse de que los usuarios y roles se cargan correctamente
        $response->assertStatus(200);
        $response->assertViewHas('users');
        $response->assertViewHas('roles');

        // Comprobar que el usuario tiene los roles esperados
        $this->assertTrue($user->hasRole('administrador'));
    }

    public function testAssignRoleAsignaRolAUsuario()
    {
        // Crear un usuario para simular autenticación
        $user = User::factory()->create();

        // Crear un rol para asignar
        $role = Role::create(['name' => 'editor']);

        // Simula una solicitud para asignar un rol al usuario
        $response = $this->actingAs($user)->post(route('users.assignRole', $user->id), [
            'role_id' => $role->id,
        ]);

        // Asegurarse de que el rol ha sido asignado correctamente
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Rol asignado correctamente.');

        // Verificar que el rol se asignó correctamente
        $user->refresh();
        $this->assertTrue($user->hasRole('editor'));
    }

    
}
