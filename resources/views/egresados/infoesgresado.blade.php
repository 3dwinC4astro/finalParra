@extends('adminlte::page')

@section('title', 'Información del Egresado')

@section('content_header')
    <a href="{{ route('egresados.index') }}" class="btn btn-secondary">
        Regresar a Egresados
    </a>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-3">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Información del Egresado</h3>
                </div>
                <div class="card-body">
                    <p><strong>Número de Identificación:</strong> {{ $egresado->numero_identificacion }}</p>
                    <p><strong>Nombres:</strong> {{ $user->name }}</p>
                    <p><strong>Dirección:</strong> {{ $egresado->direccion }}</p>
                    <p><strong>Teléfono:</strong> {{ $egresado->telefono }}</p>
                    <p><strong>Correo Electrónico:</strong> {{ $user->email }}</p> <!-- Mostrar correo del usuario -->
                    <p><strong>Programa Académico:</strong> {{ $egresado->programa_academico }}</p>
                    <p><strong>Fecha de Inicio de Pregrado:</strong> {{ $egresado->fecha_inicio_pregrado }}</p>
                    <p><strong>Fecha de Fin de Pregrado:</strong> {{ $egresado->fecha_fin_pregrado }}</p>
                    <p><strong>Estado:</strong> 
                        <span class="badge {{ $user->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($user->estado) }} <!-- Mostrar estado del usuario -->
                        </span>
                   
                   
                   
                   

                   
                   
                   
                    </p>

                    <div class="card shadow mb-3">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Información Laboral</h3>
                </div>
                <div class="card-body">
                    @if ($infoLaboral->isEmpty())
                        <p>No se encontró información laboral para este egresado.</p>
                    @else
                        @foreach ($infoLaboral as $info)
                            <p><strong>Nombre de la Empresa:</strong> {{ $info->nombre_empresa }}</p>
                            <p><strong>Cargo:</strong> {{ $info->cargo }}</p>
                            <p><strong>Fecha de Inicio:</strong> {{ $info->fecha_inicio }}</p>
                            <p><strong>Fecha de Finalización:</strong> {{ $info->fecha_finalizacion }}</p>
                            <p><strong>Nombre del Jefe Inmediato:</strong> {{ $info->nombre_jefe_inmediato }}</p>
                            <p><strong>Detalles de Contacto:</strong> {{ $info->detalles_contacto }}</p>
                            <hr> <!-- Línea de separación entre registros -->
                        @endforeach
                    @endif
                </div>

                    
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
           
            </div>
        </div>
    </div>
@stop
