@extends('layouts.arca')

@section('content')
<div class="container">
    <h1>Agregar Información Laboral</h1>
    <form action="{{ route('arca.infolaboral.store') }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    
    
    
   

        <div class="form-group">
            <label for="nombre_empresa">Nombre de la Empresa</label>
            <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required>
        </div>
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" required>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
        </div>
        <div class="form-group">
            <label for="fecha_finalizacion">Fecha de Finalización (opcional)</label>
            <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion">
        </div>
        <div class="form-group">
            <label for="nombre_jefe_inmediato">Nombre del Jefe Inmediato</label>
            <input type="text" class="form-control" id="nombre_jefe_inmediato" name="nombre_jefe_inmediato" required>
        </div>
        <div class="form-group">
            <label for="detalles_contacto">Detalles de Contacto</label>
            <input type="text" class="form-control" id="detalles_contacto" name="detalles_contacto">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
    </form>
</div>
@endsection
