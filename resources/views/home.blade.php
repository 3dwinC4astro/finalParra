@extends('adminlte::page')


@section('title', 'Usuarios y Roles')
@php
if (!auth()->user()->hasRole('administrador') && 
        !auth()->user()->hasRole('director') && 
        !auth()->user()->hasRole('docente')) {
        // Redireccionar a la ruta 'arca'
        header("Location: " . route('arca'));
        exit;
    }

    // Redirigir al usuario al login si su estado es 'inactivo'
    if (auth()->user()->estado === 'inactivo') {
        auth()->logout(); // Cerrar la sesión del usuario
        header("Location: " . route('inicio'));
        exit;
    }
@endphp
@section('content_header')
    <h1 class="text-center">Gestión Usuarios</h1>
@stop

@section('content')

    <!-- Mensajes de éxito y error -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabla de usuarios -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Lista de Usuarios</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped table-responsive-md">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol Actual</th>
                        <th>Estado</th>
                        @if (auth()->user()->hasRole('administrador'))
                            <th>Asignar Rol</th>
                            <th>Eliminar Rol</th>
                        @endif
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $user->roles->isNotEmpty() ? $user->roles->pluck('name')->implode(', ') : 'Sin rol asignado' }}
                                </span>
                            </td>
                            <td>
                                @if ($user->estado === 'activo')
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-danger">Inactivo</span>
                                @endif
                            </td>
                            @if (auth()->user()->hasRole('administrador'))
                                <td>
                                    @if ($firstAdmin && $firstAdmin->id === $user->id)
                                        <!-- No permitir cambios en el rol del primer administrador -->
                                    @else
                                        <form action="{{ route('users.assignRole', $user->id) }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <select name="role_id" required class="form-select">
                                                    <option value="">Seleccionar rol</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-plus"></i> 
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if ($firstAdmin && $firstAdmin->id === $user->id)
                                        <!-- No permitir la eliminación de roles del primer administrador -->
                                    @else
                                        <form action="{{ route('users.removeRole', ['user' => $user->id, 'role' => $role->id ?? null]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="input-group">
                                                <select name="role_id" required class="form-select">
                                                    <option value="">Seleccionar rol</option>
                                                    @foreach ($user->roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> 
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                            @endif
                            <td>
                                @if ($firstAdmin && $firstAdmin->id === $user->id)
                                    <!-- El primer administrador no puede ser activado o inactivado -->
                                @else
                                    @if ($user->estado === 'activo')
                                        <form action="{{ route('user.inactivate', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning btn-sm" title="Inactivar">
                                                        <i class="fas fa-ban"> Inactivar</i> 
                                                    </button></form>
                                    @else
                                        <form action="{{ route('user.activate', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm" title="Activar">
                                                        <i class="fas fa-check">Activar</i> 
                                                    </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
        .badge {
            font-size: 1em;
        }
        .btn {
            padding: 0.4rem 1rem;
        }
    </style>
@stop

@section('js')
    <script> console.log("Tabla de gestión de roles personalizada activada."); </script>
@stop
