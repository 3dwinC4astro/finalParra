<?php

namespace App\Http\Controllers;

use App\Models\InfoLaboral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoLaboralController extends Controller
{
    /**
     * Mostrar una lista de la información laboral del usuario logueado.
     */
   

    /**
     * Mostrar el formulario para crear un nuevo registro de información laboral.
     */
    public function create()
    {
        $user = Auth::user();

        return view('arca.infolaboral.create', compact('user'));
    }

    /**
     * Almacenar un nuevo registro de información laboral.
     */
    public function store(Request $request)
{
    $request->validate([
        'nombre_empresa' => 'required|string|max:255',
        'cargo' => 'required|string|max:255',
        'fecha_inicio' => 'required|date',
        'fecha_finalizacion' => 'nullable|date|after_or_equal:fecha_inicio', // Validar que sea posterior a la fecha de inicio
        'nombre_jefe_inmediato' => 'required|string|max:255',
        'detalles_contacto' => 'nullable|string|max:255',
        'user_id' => 'required|exists:users,id', // Validar que el usuario exista
    ]);

    InfoLaboral::create([
        'user_id' => $request->user_id, // Usar user_id en lugar de egresado_id si es el caso
        'nombre_empresa' => $request->nombre_empresa,
        'cargo' => $request->cargo,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_finalizacion' => $request->fecha_finalizacion,
        'nombre_jefe_inmediato' => $request->nombre_jefe_inmediato,
        'detalles_contacto' => $request->detalles_contacto,
    ]);

    return redirect()->route('arcalaboral')->with('success', 'Información laboral agregada correctamente.');
}

    

    /**
     * Mostrar el formulario para editar un registro de información laboral.
     */
    public function edit($id)
{
    $infoLaboral = InfoLaboral::findOrFail($id);
    return view('arca.infolaboral.edit', compact('infoLaboral'));
}


    /**
     * Actualizar un registro específico de información laboral.
     */
    public function update(Request $request, $id)
{
    
    // Validar los datos del formulario
    $request->validate([
        'nombre_empresa' => 'required|string|max:255',
        'cargo' => 'required|string|max:255',
        'fecha_inicio' => 'required|date',
        'fecha_finalizacion' => 'nullable|date|after_or_equal:fecha_inicio',
        'nombre_jefe_inmediato' => 'required|string|max:255',
        'detalles_contacto' => 'nullable|string|max:255',
    ]);

    $infoLaboral = InfoLaboral::findOrFail($id);
    $infoLaboral->update($request->only([
        'nombre_empresa',
        'cargo',
        'fecha_inicio',
        'fecha_finalizacion',
        'nombre_jefe_inmediato',
        'detalles_contacto',
    ]));

    // Redirigir con un mensaje de éxito
    return redirect()->route('arcalaboral')->with('success', 'Información laboral actualizada exitosamente.');
}


    /**
     * Eliminar un registro específico de información laboral.
     */
    public function destroy(InfoLaboral $infoLaboral)
{
    // Verificar si el usuario autenticado es el propietario de la información laboral
    if ($infoLaboral->user_id != Auth::id()) {
        return redirect()->route('arcalaboral')->with('error', 'Acción no autorizada.');
    }

    // Eliminar el registro
    $infoLaboral->delete();

    // Redirigir con un mensaje de éxito
    return redirect()->route('arcalaboral')->with('success', 'Información laboral eliminada exitosamente.');
}

}
