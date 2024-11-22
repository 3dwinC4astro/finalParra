@extends('layouts.arca')

@section('content')
@php
    // Redirigir al usuario al login si su estado es 'inactivo'
    if (auth()->check() && auth()->user()->estado === 'inactivo') {
        auth()->logout(); // Cerrar la sesión del usuario
        redirect()->route('inicio')->send(); // Redireccionar a la ruta 'inicio'
        exit;
    }
@endphp

<div class="container mt-5" style="max-width: 600px;">
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <!-- Mostrar el rol actual del usuario y sus permisos -->
    @if(auth()->user()->roles->isEmpty())
        <div class="alert alert-danger">Vista Denegada: No tienes permisos suficientes para acceder a esta sección.</div>
    @else
        <form action="{{ route('infopersonal') }}" method="POST" class="p-4 border rounded shadow" style="border-color: #007BFF; transition: transform 0.3s;">
            @csrf
            <h2 class="text-center mb-4" style="color: #0F2E5F;">Información Personal</h2>
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="form-group">
                <label for="numero_identificacion" style="color: #0F2E5F;">Número de Identificación</label>
                <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion" 
                       value="{{ old('numero_identificacion', $egresado->numero_identificacion ?? '') }}" required
                       style="border: 1px solid #0F2E5F;">
            </div>

            <div class="form-group">
                <label for="direccion" style="color: #0F2E5F;">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" 
                       value="{{ old('direccion', $egresado->direccion ?? '') }}" required
                       style="border: 1px solid #0F2E5F;">
            </div>

            <div class="form-group">
                <label for="telefono" style="color: #0F2E5F;">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" 
                       value="{{ old('telefono', $egresado->telefono ?? '') }}" required
                       style="border: 1px solid #0F2E5F;">
            </div>

            <h3 class="text-center mb-4" style="color: #0F2E5F;">Información Académica</h3>
            <div class="form-group">
                <label for="programa_academico" style="color: #0F2E5F;">Programa Académico</label>
                <input type="text" class="form-control" id="programa_academico" name="programa_academico" 
                       value="{{ old('programa_academico', $egresado->programa_academico ?? '') }}" required
                       style="border: 1px solid #0F2E5F;">
            </div>

            <div class="form-group">
                <label for="fecha_inicio_pregrado" style="color: #0F2E5F;">Fecha de Inicio del Pregrado</label>
                <input type="date" class="form-control" id="fecha_inicio_pregrado" name="fecha_inicio_pregrado" 
                       value="{{ old('fecha_inicio_pregrado', $egresado->fecha_inicio_pregrado ?? '') }}" required
                       style="border: 1px solid #0F2E5F;">
            </div>

            <div class="form-group">
                <label for="fecha_fin_pregrado" style="color: #0F2E5F;">Fecha de Finalización del Pregrado</label>
                <input type="date" class="form-control" id="fecha_fin_pregrado" name="fecha_fin_pregrado" 
                       value="{{ old('fecha_fin_pregrado', $egresado->fecha_fin_pregrado ?? '') }}" required
                       style="border: 1px solid #0F2E5F;">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        </form>
    @endif
</div>
@endsection
