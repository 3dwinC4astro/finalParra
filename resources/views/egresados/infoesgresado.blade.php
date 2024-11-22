@extends('adminlte::page')

@section('title', 'Información del Egresado')

@section('content_header')
    <a href="{{ route('egresados.index') }}" class="btn btn-secondary">
        Regresar a Egresados
    </a>
@stop

@section('content')
    <div class="row">
        <!-- Tarjeta de Información Personal -->
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Información Personal del Egresado</h3>
                </div>
                <div class="card-body">
               @if($user && $user->imagen)
    <img src="data:image/jpeg;base64,{{ base64_encode($user->imagen) }}" alt="Imagen de usuario" class="rounded-circle" style="width: 170px; height: 170px; object-fit: cover;">
@else
    <img src="https://green.excertia.com/wp-content/uploads/2020/04/perfil-empty.png" alt="Imagen de usuario" class="rounded-circle" style="width: 170px; height: 170px; object-fit: cover;">
@endif

                    <p><strong>Número de Identificación:</strong> {{ $egresado->numero_identificacion }}</p>
                    <p><strong>Nombres:</strong> {{ $user->name }}</p>
                    <p><strong>Dirección:</strong> {{ $egresado->direccion }}</p>
                    <p><strong>Teléfono:</strong> {{ $egresado->telefono }}</p>
                    <p><strong>Correo Electrónico:</strong> {{ $user->email }}</p>
                    <p><strong>Programa Académico:</strong> {{ $egresado->programa_academico }}</p>
                    <p><strong>Fecha de Inicio de Pregrado:</strong> {{ $egresado->fecha_inicio_pregrado }}</p>
                    <p><strong>Fecha de Fin de Pregrado:</strong> {{ $egresado->fecha_fin_pregrado }}</p>
                    <p><strong>Estado:</strong>
                        <span class="badge {{ $user->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($user->estado) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Información Laboral -->
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Información Laboral</h3>
                </div>
                <div class="card-body">
                    @if ($infoLaboral->isEmpty())
                        <p>No se encontró información laboral para este egresado.</p>
                    @else
                        @foreach ($infoLaboral as $info)
                            <div class="mb-3">
                                <p><strong>Nombre de la Empresa:</strong> {{ $info->nombre_empresa }}</p>
                                <p><strong>Cargo:</strong> {{ $info->cargo }}</p>
                                <p><strong>Fecha de Inicio:</strong> {{ $info->fecha_inicio }}</p>
                                <p><strong>Fecha de Finalización:</strong> {{ $info->fecha_finalizacion }}</p>
                                <p><strong>Nombre del Jefe Inmediato:</strong> {{ $info->nombre_jefe_inmediato }}</p>
                                <p><strong>Detalles de Contacto:</strong> {{ $info->detalles_contacto }}</p>
                                <hr> <!-- Línea de separación -->
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
