@extends('adminlte::page')

@section('title', 'Ofertas Laborales')

@section('content_header')
    <h1 class="text-center">Gestión de Ofertas Laborales</h1>
@stop

@section('content')

    <!-- Estilo para truncar texto -->
    <style>
        .truncate-text {
            max-width: 150px; /* Ajusta el ancho máximo según sea necesario */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>

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

        <!-- Botón para agregar ofertas si es administrador, director o docente -->
        @if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('director') || auth()->user()->hasRole('docente'))
            <a href="{{ route('ofertas.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i> Agregar Oferta
            </a>
        @endif

        <!-- Tabla de ofertas laborales -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Lista de Ofertas Laborales</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped table-responsive-md">
                    <thead class="table-dark">
                        <tr>
                            <th>Cargo</th>
                            <th>Descripción</th>
                            <th>Requisitos</th>
                            <th>Nombre Empresa</th>
                            <th>Contacto</th>
                            <th>Email</th>
                            <th>Ciudad</th>
                            <th>Estado</th>
                            @if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('director') || auth()->user()->hasRole('docente'))
                                <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ofertas as $oferta)
                            <tr>
                                <td class="truncate-text">{{ $oferta->cargo }}</td>
                                <td class="truncate-text">{{ $oferta->descripcion }}</td>
                                <td class="truncate-text">{{ $oferta->requisitos }}</td>
                                <td class="truncate-text">{{ $oferta->nombre_empresa }}</td>
                                <td class="truncate-text">{{ $oferta->contacto_empresa }}</td>
                                <td class="truncate-text">{{ $oferta->correo_empresa }}</td>
                                <td class="truncate-text">{{ $oferta->ciudad_empresa }}</td>
                                <td>
                                    <span class="badge {{ $oferta->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($oferta->estado) }}
                                    </span>
                                </td>
                                @if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('director') || auth()->user()->hasRole('docente'))
                                    <td>
                                        <a href="{{ route('ofertas.edit', $oferta->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        @if($oferta->estado == 'inactivo')
                                                <form action="{{ route('ofertas.activate', $oferta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de activar esta oferta?');" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm" title="Activar">
                                                        <i class="fas fa-check">Activar</i> 
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('ofertas.inactivate', $oferta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de inactivar esta oferta?');" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-warning btn-sm" title="Inactivar">
                                                        <i class="fas fa-ban">Inactivar</i> 
                                                    </button>
                                                </form>
                                            @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@stop
