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

@if(auth()->user()->roles->isEmpty())
    <div class="container mt-5">
        <div class="alert alert-danger">
            Vista Denegada: No tienes permisos suficientes para acceder a esta sección.
        </div>
    </div>
@else
    <div class="container">
        <h1>Información Laboral</h1>
        <a href="{{ route('arca.infolaboral.create') }}" class="btn btn-primary mb-3">Agregar Información Laboral</a>

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

        @if($infoLaborales->isEmpty())
            <p>No hay información laboral disponible.</p>
        @else
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Nombre Empresa</th>
                        <th>Cargo</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Finalización</th>
                        <th>Nombre Jefe Inmediato</th>
                        <th>Detalles de Contacto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($infoLaborales as $info)
                        <tr>
                            <td>{{ $info->nombre_empresa }}</td>
                            <td>{{ $info->cargo }}</td>
                            <td>{{ $info->fecha_inicio  }}</td>
                            <td>{{ $info->fecha_finalizacion }}</td>
                            <td>{{ $info->nombre_jefe_inmediato }}</td>
                            <td>{{ $info->detalles_contacto ?? 'No disponible' }}</td>
                            <td>
                                <a href="{{ route('arca.infolaboral.edit', $info->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('arca.infolaboral.destroy', $info->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta información laboral?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endif
@endsection
