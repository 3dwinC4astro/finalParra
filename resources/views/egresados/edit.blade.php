@extends('adminlte::page')

@section('title', 'Editar Egresado')

@section('content_header')
    <h1>Editar Egresado</h1>
@stop

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <form action="{{ route('egresados.update', $egresado->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Utilizamos PUT para la actualización de datos -->

        <div class="form-group">
            <label for="user_id">Usuario Asociado</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $egresado->user_id ? 'selected' : '' }}>
                        {{ $user->id }} - {{ $user->name }} - {{ $user->email }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="numero_identificacion">Número de Identificación</label>
            <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion" 
                value="{{ old('numero_identificacion', $egresado->numero_identificacion) }}" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" 
                value="{{ old('direccion', $egresado->direccion) }}" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" 
                value="{{ old('telefono', $egresado->telefono) }}" required>
        </div>

        <div class="form-group">
            <label for="programa_academico">Programa Académico</label>
            <input type="text" class="form-control" id="programa_academico" name="programa_academico" 
                value="{{ old('programa_academico', $egresado->programa_academico) }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio_pregrado">Fecha de Inicio de Pregrado</label>
            <input type="date" class="form-control" id="fecha_inicio_pregrado" name="fecha_inicio_pregrado" 
                value="{{ old('fecha_inicio_pregrado', $egresado->fecha_inicio_pregrado) }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin_pregrado">Fecha de Fin de Pregrado</label>
            <input type="date" class="form-control" id="fecha_fin_pregrado" name="fecha_fin_pregrado" 
                value="{{ old('fecha_fin_pregrado', $egresado->fecha_fin_pregrado) }}" required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('egresados.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@stop
