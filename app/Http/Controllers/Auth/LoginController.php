<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador maneja la autenticación de usuarios para la aplicación
    | y los redirige a la pantalla de inicio. El controlador usa un trait
    | para proporcionar convenientemente su funcionalidad a las aplicaciones.
    |
    */

    use AuthenticatesUsers;

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware para manejar el acceso según el estado del usuario (invitado o autenticado)
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirigir según el rol del usuario autenticado.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Verificar el rol del usuario y redirigir según el rol
        if ($user->hasAnyRole(['administrador', 'docente', 'director'])) {
            // Redirigir al 'home' si el usuario tiene un rol específico
            return redirect()->route('users.index');
        } else {
            // Redirigir a la página 'arca' si el usuario no tiene uno de los roles anteriores
            return redirect()->route('arca'); // Asegúrate de tener esta ruta definida en routes/web.php
        }
    }
}
