<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EgresadoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfertaLaboralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoLaboralController;
use App\Http\Controllers\InfoPersonalController;




// Rutas de autenticación
Auth::routes();

// Ruta principal
Route::get('/', function () {
    return view('auth.login');
})->name('inicio');



// Rutas protegidas por autenticación y estado del usuario
Route::middleware(['auth'])->group(function () {

    // Rutas para gestionar usuarios (Roles y Activación)
    Route::get('/home', [UserController::class, 'index'])->name('users.index');
    Route::post('/home/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');
   
    Route::delete('/home/{user}/remove-role', [UserController::class, 'removeRole'])->name('users.removeRole');
    Route::patch('/home/{user}/activate', [UserController::class, 'activate'])->name('user.activate');
    Route::patch('/home/{user}/deactivate', [UserController::class, 'deactivate'])->name('user.inactivate');
    Route::post('/update-image/{user}', [UserController::class, 'updateImage'])->name('user.updateImage');


    // Rutas para gestionar egresados
    Route::resource('egresados', EgresadoController::class);
    Route::get('/egresados/create', [EgresadoController::class, 'create'])->name('egresados.create');
    Route::post('/egresados', [EgresadoController::class, 'store'])->name('egresados.store');
    Route::get('/egresados/{egresado}/edit', [EgresadoController::class, 'edit'])->name('egresados.edit');
    Route::put('/egresados/{egresado}', [EgresadoController::class, 'update'])->name('egresados.update');
    Route::get('/egresados/{id}', [EgresadoController::class, 'show'])->name('infoesgresado');
  


    // Rutas para gestionar ofertas laborales
    Route::resource('ofertas', OfertaLaboralController::class);
    Route::patch('ofertas/{id}/activate', [OfertaLaboralController::class, 'activar'])->name('ofertas.activate');
    Route::patch('ofertas/{id}/inactivate', [OfertaLaboralController::class, 'inactivar'])->name('ofertas.inactivate');
});


// Rutas protegidas por autenticación y estado del usuario
Route::middleware(['auth'])->group(function () {
    Route::get('/arca', [HomeController::class, 'arca'])->name('arca');


    Route::get('/arca/infolaborale', [HomeController::class, 'infolaboral'])->name('arcalaboral');
   

  

    // Ruta para mostrar el formulario de creación
    Route::get('infolaboral/create', [InfoLaboralController::class, 'create'])->name('arca.infolaboral.create');

    // Ruta para almacenar una nueva información laboral
    Route::post('infolaboral', [InfoLaboralController::class, 'store'])->name('arca.infolaboral.store');

    // Ruta para mostrar el formulario de edición
    Route::get('infolaboral/{infoLaboral}/edit', [InfoLaboralController::class, 'edit'])->name('arca.infolaboral.edit');

    // Ruta para actualizar la información laboral
    Route::put('infolaboral/{infoLaboral}', [InfoLaboralController::class, 'update'])->name('arca.infolaboral.update');

    // Ruta para eliminar la información laboral
    Route::delete('infolaboral/{infoLaboral}', [InfoLaboralController::class, 'destroy'])->name('arca.infolaboral.destroy');


    // Ruta para mostrar el formulario de información personal
Route::get('/infopersonal', [InfoPersonalController::class, 'index'])->name('infopersonal');

// Ruta para almacenar la información actualizada o crear nueva
Route::post('/infopersonal', [InfoPersonalController::class, 'update'])->name('infopersonal.store');
});
