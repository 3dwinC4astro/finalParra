<?php

namespace App\Http\Controllers;

use App\Models\OfertaLaboral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfertaLaboralController extends Controller
{
    public function index()
    {
        $ofertas = OfertaLaboral::all();
        return view('ofertas.index', compact('ofertas'));
    }

    public function create()
    {
        return view('ofertas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cargo' => 'required|string|max:255',
            'descripcion' => 'required',
            'requisitos' => 'required',
            'nombre_empresa' => 'required|string|max:255',
            'contacto_empresa' => 'required|string|max:255',
            'correo_empresa' => 'required|email|max:255',
            'ciudad_empresa' => 'required|string|max:255',
            'estado' => 'required|string|in:activo,inactivo', // Validación del estado
        ]);

        OfertaLaboral::create([
            'cargo' => $request->cargo,
            'descripcion' => $request->descripcion,
            'requisitos' => $request->requisitos,
            'nombre_empresa' => $request->nombre_empresa,
            'contacto_empresa' => $request->contacto_empresa,
            'correo_empresa' => $request->correo_empresa,
            'ciudad_empresa' => $request->ciudad_empresa,
            'estado' => $request->estado, // Guardar el estado
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('ofertas.index')->with('success', 'Oferta laboral creada con éxito.');
    }

    public function edit(OfertaLaboral $oferta)
    {
        return view('ofertas.edit', compact('oferta'));
    }

    public function update(Request $request, OfertaLaboral $oferta)
    {
        $request->validate([
            'cargo' => 'required|string|max:255',
            'descripcion' => 'required',
            'requisitos' => 'required',
            'nombre_empresa' => 'required|string|max:255',
            'contacto_empresa' => 'required|string|max:255',
            'correo_empresa' => 'required|email|max:255',
            'ciudad_empresa' => 'required|string|max:255',
            'estado' => 'required|string|in:activo,inactivo', // Validación del estado
        ]);

        $oferta->update($request->all());

        return redirect()->route('ofertas.index')->with('success', 'Oferta laboral actualizada con éxito.');
    }

    public function activar($id)
    {
        $oferta = OfertaLaboral::findOrFail($id);
        $oferta->estado = 'activo';
        $oferta->save();

        return redirect()->route('ofertas.index')->with('success', 'Oferta laboral activada con éxito.');
    }

    public function inactivar($id)
    {
        $oferta = OfertaLaboral::findOrFail($id);
        $oferta->estado = 'inactivo';
        $oferta->save();

        return redirect()->route('ofertas.index')->with('success', 'Oferta laboral inactivada con éxito.');
    }
}
