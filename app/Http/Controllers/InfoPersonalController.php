<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Egresado; // Asegúrate de tener este modelo
use Illuminate\Support\Facades\Auth;

class InfoPersonalController extends Controller
{
    /**
     * Muestra el formulario con la información personal para editar.
     */
    public function index()
    {
        $user = Auth::user();
        $egresado = Egresado::where('user_id', $user->id)->first();

        return view('arca.infopersonal', compact('user', 'egresado'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'numero_identificacion' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'programa_academico' => 'required|string|max:255',
            'fecha_inicio_pregrado' => 'required|date',
            'fecha_fin_pregrado' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);
    
        // Buscar un registro existente del usuario
        $egresado = Egresado::where('user_id', $request->user_id)->first();
    
        if ($egresado) {
            // Si existe, actualizarlo
            $egresado->update([
                'numero_identificacion' => $request->numero_identificacion,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'programa_academico' => $request->programa_academico,
                'fecha_inicio_pregrado' => $request->fecha_inicio_pregrado,
                'fecha_fin_pregrado' => $request->fecha_fin_pregrado,
            ]);
    
            return redirect()->route('infopersonal')->with('success', 'Información actualizada correctamente.');
        } else {
            // Si no existe, crear uno nuevo
            Egresado::create([
                'numero_identificacion' => $request->numero_identificacion,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'programa_academico' => $request->programa_academico,
                'fecha_inicio_pregrado' => $request->fecha_inicio_pregrado,
                'fecha_fin_pregrado' => $request->fecha_fin_pregrado,
                'user_id' => $request->user_id,
            ]);
    
            return redirect()->route('infopersonal')->with('success', 'Información registrada exitosamente.');
        }
    }
}
