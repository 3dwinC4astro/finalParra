@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2>Crear Nueva Oferta Laboral</h2>
        <form action="{{ route('ofertas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" name="cargo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="requisitos" class="form-label">Requisitos</label>
                <textarea name="requisitos" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="nombre_empresa" class="form-label">Nombre de la Empresa</label>
                <input type="text" name="nombre_empresa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contacto_empresa" class="form-label">Contacto de la Empresa</label>
                <input type="text" name="contacto_empresa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="correo_empresa" class="form-label">Correo Electrónico de la Empresa</label>
                <input type="email" name="correo_empresa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ciudad_empresa" class="form-label">Ciudad de la Empresa</label>
                <input type="text" name="ciudad_empresa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" class="form-select" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Publicar Oferta</button>
        </form>
    </div>
@endsection
