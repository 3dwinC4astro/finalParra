@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2>Editar Oferta Laboral</h2>
        <form action="{{ route('ofertas.update', $oferta->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" name="cargo" class="form-control" value="{{ $oferta->cargo }}" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3" required>{{ $oferta->descripcion }}</textarea>
            </div>
            <div class="mb-3">
                <label for="requisitos" class="form-label">Requisitos</label>
                <textarea name="requisitos" class="form-control" rows="3" required>{{ $oferta->requisitos }}</textarea>
            </div>
            <div class="mb-3">
                <label for="nombre_empresa" class="form-label">Nombre de la Empresa</label>
                <input type="text" name="nombre_empresa" class="form-control" value="{{ $oferta->nombre_empresa }}" required>
            </div>
            <div class="mb-3">
                <label for="contacto_empresa" class="form-label">Contacto de la Empresa</label>
                <input type="text" name="contacto_empresa" class="form-control" value="{{ $oferta->contacto_empresa }}" required>
            </div>
            <div class="mb-3">
                <label for="correo_empresa" class="form-label">Correo Electrónico de la Empresa</label>
                <input type="email" name="correo_empresa" class="form-control" value="{{ $oferta->correo_empresa }}" required>
            </div>
            <div class="mb-3">
                <label for="ciudad_empresa" class="form-label">Ciudad de la Empresa</label>
                <input type="text" name="ciudad_empresa" class="form-control" value="{{ $oferta->ciudad_empresa }}" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" class="form-select" required>
                    <option value="activo" {{ $oferta->estado === 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ $oferta->estado === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Oferta</button>
        </form>
    </div>
@endsection
