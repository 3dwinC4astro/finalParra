@extends('layouts.arca')

@section('content')
<div class="container">
    <h1>Editar Información Laboral</h1>
    <form action="{{ route('arca.infolaboral.update', $infoLaboral->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre_empresa">Nombre de la Empresa</label>
            <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" value="{{ old('nombre_empresa', $infoLaboral->nombre_empresa) }}" required>
        </div>

        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo', $infoLaboral->cargo) }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $infoLaboral->fecha_inicio) }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_finalizacion">Fecha de Finalización (opcional)</label>
            <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" value="{{ old('fecha_finalizacion', $infoLaboral->fecha_finalizacion) }}">
        </div>

        <div class="form-group">
            <label for="nombre_jefe_inmediato">Nombre del Jefe Inmediato</label>
            <input type="text" class="form-control" id="nombre_jefe_inmediato" name="nombre_jefe_inmediato" value="{{ old('nombre_jefe_inmediato', $infoLaboral->nombre_jefe_inmediato) }}" required>
        </div>

        <div class="form-group">
            <label for="detalles_contacto">Detalles de Contacto</label>
            <input type="text" class="form-control" id="detalles_contacto" name="detalles_contacto" value="{{ old('detalles_contacto', $infoLaboral->detalles_contacto) }}">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
    </form>
</div>
@endsection
