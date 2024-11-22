@extends('adminlte::page')

@section('title', 'Egresados')

@section('content_header')
    <h1 class="text-center">Gestión de Egresados</h1>
@stop

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

        <!-- Botón para agregar egresados si es administrador o director -->
        @if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('director') || auth()->user()->hasRole('docente'))

            <a href="{{ route('egresados.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i> Agregar Egresado
            </a>
        @endif

        <!-- Tabla de egresados -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Lista de Egresados</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped table-responsive-md">
                    <thead class="table-dark">
                        <tr>
                            <th>Identificación</th>
                            <th>Nombres</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo Electrónico</th>
                            <th>Programa</th>
                            <th>Inicio de Pregrado</th>
                            <th>Fin de Pregrado</th>
                            @if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('director') || auth()->user()->hasRole('docente'))
                            <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($egresados as $egresado)
                            <tr>
                                <td>{{ $egresado->numero_identificacion }}</td>
                                <td>{{ $egresado->user->name }}</td> <!-- Accediendo al nombre del usuario -->
                                <td>{{ $egresado->direccion }}</td>
                                <td>{{ $egresado->telefono }}</td>
                                <td>{{ $egresado->user->email }}</td> <!-- Accediendo al correo del usuario -->
                                <td>{{ $egresado->programa_academico }}</td>
                                <td>{{ $egresado->fecha_inicio_pregrado }}</td>
                                <td>{{ $egresado->fecha_fin_pregrado }}</td>
                                
                                @if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('director') || auth()->user()->hasRole('docente'))
    <td>
                                        <div class="d-flex justify-content-around">
                                            <a href="{{ route('infoesgresado', $egresado->id) }}" class="btn bg-primary btn-sm" title="Ver Egresado">
                                                <i class="fas fa-eye">Ver</i>
                                            </a>
                                            <a href="{{ route('egresados.edit', $egresado->id) }}" class="btn btn-info btn-sm" title="Modificar">
                                                <i class="fas fa-edit">Editar</i> 
                                            </a>
                                        </div>
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

@section('css')
    <style>
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        .table {
            margin-bottom: 0;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn {
            padding: 0.4rem 1rem;
        }
        .badge {
            font-size: 1em;
        }
    </style>
@stop

@section('js')
    <script> console.log("Gestión de egresados personalizada activada."); </script>
@stop
