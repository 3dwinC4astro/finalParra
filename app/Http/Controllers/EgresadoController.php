<?php

namespace App\Http\Controllers;

use App\Models\Egresado;
use App\Models\User; // Importar el modelo de User
use Illuminate\Http\Request;
use App\Models\InfoLaboral;

class EgresadoController extends Controller
{
    // Muestra la lista de egresados
    public function index()
    {
        $egresados = Egresado::with('user')->get(); // Obtener todos los egresados con la relación 'user'
        return view('egresados.index', compact('egresados'));
    }

    // Muestra el formulario para crear un nuevo egresado
    public function create()
{
    $users = User::all(); // Obtener todos los usuarios para el select
    return view('egresados.create', compact('users')); // Pasar los usuarios a la vista
}


    // Almacena un nuevo egresado
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'numero_identificacion' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'programa_academico' => 'required',
            'fecha_inicio_pregrado' => 'required|date',
            'fecha_fin_pregrado' => 'required|date',
            'user_id' => 'required|exists:users,id', // Asegura que el ID del usuario sea válido
        ]);
    
        // Crear un nuevo egresado
        $egresado = new Egresado();
        $egresado->numero_identificacion = $request->numero_identificacion;
        $egresado->direccion = $request->direccion;
        $egresado->telefono = $request->telefono;
        $egresado->programa_academico = $request->programa_academico;
        $egresado->fecha_inicio_pregrado = $request->fecha_inicio_pregrado;
        $egresado->fecha_fin_pregrado = $request->fecha_fin_pregrado;
        $egresado->user_id = $request->user_id; // El ID del usuario se pasa correctamente
        $egresado->save();
    
        return redirect()->route('egresados.index');
    }
    

    // Muestra el formulario para editar un egresado existente
    public function edit(Egresado $egresado)
    {
        $users = User::all(); // Obtener todos los usuarios para el select
        return view('egresados.edit', compact('egresado', 'users'));
    }

    // Actualiza un egresado existente
    public function update(Request $request, $id)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'numero_identificacion' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'telefono' => 'required|string|max:20',
        'programa_academico' => 'required|string|max:255',
        'fecha_inicio_pregrado' => 'required|date',
        'fecha_fin_pregrado' => 'required|date',
    ]);

    $egresado = Egresado::findOrFail($id);
    $egresado->update([
        'user_id' => $request->user_id,
        'numero_identificacion' => $request->numero_identificacion,
        'direccion' => $request->direccion,
        'telefono' => $request->telefono,
        'programa_academico' => $request->programa_academico,
        'fecha_inicio_pregrado' => $request->fecha_inicio_pregrado,
        'fecha_fin_pregrado' => $request->fecha_fin_pregrado,
    ]);

    return redirect()->route('egresados.index')->with('success', 'Egresado actualizado con éxito.');
}


    // Elimina un egresado existente
    public function destroy(Egresado $egresado)
    {
        $egresado->delete();
        return redirect()->route('egresados.index')->with('success', 'Egresado eliminado con éxito');
    }




    public function show($id)
    {
        // Buscar el egresado por su ID
        $egresado = Egresado::findOrFail($id);
    
        // Obtener el usuario asociado al egresado
        $user = $egresado->user;
    
        // Verificar que el usuario existe antes de intentar obtener la información laboral
        if ($user) {
            // Obtener la información laboral del usuario asociado
            $infoLaboral = InfoLaboral::where('user_id', $user->id)->get();
        } else {
            // Si el usuario no existe, la información laboral será un array vacío
            $infoLaboral = collect();
        }
    
        // Retornar la vista con los datos del usuario y la información laboral
        return view('egresados.infoesgresado', compact('egresado', 'user', 'infoLaboral'));
    }
    
    
}
