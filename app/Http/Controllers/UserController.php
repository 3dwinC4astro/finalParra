<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        
        // Obtener el primer usuario con el rol de administrador
        $firstAdmin = User::role('administrador')->orderBy('id')->first();
    
        return view('home', compact('users', 'roles', 'firstAdmin'));
    }

    public function assignRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($userId);
        $role = Role::find($request->role_id); // Corregido a Role::find

        // Verificar si el usuario ya tiene el rol
        if ($user->hasRole($role->name)) {
            return redirect()->back()->with('error', 'El usuario ya tiene este rol asignado.');
        }

        // Asignar el rol al usuario
        $user->assignRole($role->name);

        return redirect()->back()->with('success', 'Rol asignado correctamente.');
    }

    public function removeRole(Request $request, $userId)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($userId);
        $role = Role::find($request->role_id); // Corregido a Role::find

        // Verificar si el usuario tiene el rol
        if (!$user->hasRole($role->name)) {
            return redirect()->back()->with('error', 'El usuario no tiene este rol asignado.');
        }

        // Eliminar el rol del usuario
        $user->removeRole($role->name);

        return redirect()->back()->with('success', 'Rol eliminado correctamente.');
    }


  public function updateImage(Request $request, $userId)
{
    // Validar la imagen cargada
    $request->validate([
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Encontrar al usuario
    $user = User::findOrFail($userId);

    // Verificar si se ha cargado una imagen
    if ($request->hasFile('imagen')) {
        // Obtener la imagen cargada
        $image = $request->file('imagen');

        // Convertir la imagen a formato binario
        $imageBinary = file_get_contents($image->getRealPath());

        // Guardar o actualizar la imagen en la base de datos
        $user->imagen = $imageBinary;
        $user->save();
    }

    // Redirigir con éxito
    return redirect()->back()->with('success', 'Imagen actualizada correctamente.');
}
}
