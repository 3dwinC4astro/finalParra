@extends('layouts.arca')

@section('title', 'Ofertas Laborales')

@php
    // Redirigir al usuario al login si su estado es 'inactivo'
    if (auth()->user()->estado === 'inactivo') {
        auth()->logout(); // Cerrar la sesión del usuario
        redirect()->route('inicio')->send(); // Redireccionar a la ruta 'inicio'
        exit;
    }
@endphp

@section('content')

    <!-- Mensajes de éxito y error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Mostrar el rol actual del usuario y sus permisos -->
    @if(auth()->user()->roles->isEmpty())
        <div class="alert alert-danger">Vista Denegada: No tienes permisos suficientes para acceder a esta sección.</div>
    @else

        <!-- Botón para agregar ofertas si es administrador o director -->
        @if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('director'))
            <a href="{{ route('ofertas.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i> Agregar Oferta
            </a>
        @endif

        <!-- Verificar si existen ofertas -->
        @if($ofertas->where('estado', 'activo')->isEmpty())
            <div class="alert alert-info text-center">
                No existen ofertas actualmente.
            </div>
        @else
            <!-- Mostrar ofertas laborales en cards solo activas -->
            <div class="row justify-content-center">
                @foreach($ofertas->where('estado', 'activo') as $oferta)
                    <div class="col-md-5 mb-4">
                        <div class="card shadow-lg border-0" style="border-radius: 20px; background: linear-gradient(135deg, #dcdcdc, #ffffff);">
                            <div class="card-header bg-dark text-white" style="border-radius: 20px 20px 0 0;">
                                <h5 class="card-title">{{ $oferta->cargo }}</h5>
                            </div>
                            <div class="card-body" style="border-radius: 0 0 20px 20px;">
                                <p><strong>Descripción:</strong> {{ $oferta->descripcion }}</p>
                                <p><strong>Requisitos:</strong> {{ $oferta->requisitos }}</p>
                                <p><strong>Nombre de la Empresa:</strong> {{ $oferta->nombre_empresa }}</p>
                                <p><strong>Contacto:</strong> {{ $oferta->contacto_empresa }}</p>
                                <p><strong>Email:</strong> {{ $oferta->correo_empresa }}</p>
                                <p><strong>Ciudad:</strong> {{ $oferta->ciudad_empresa }}</p>
                                <p><strong>Publicado por:</strong> {{ $oferta->user->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

@endsection
