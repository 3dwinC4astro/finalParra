@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #f8f9fa; padding: 50px; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-6"> <!-- Mantener col-md-6 para un diseño angosto -->
            <div class="card shadow-sm"> <!-- Añadido sombra para mayor profundidad -->
                <div class="card-header text-center" style="background-color: #007bff; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <h4>{{ __('Iniciar Sesión') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Mostrar errores de autenticación -->
                        @if ($errors->has('message'))
                            <div class="alert alert-danger text-center">
                                {{ $errors->first('message') }}
                            </div>
                        @endif

                        <div class="mb-4"> <!-- Aumentado el margen inferior -->
                            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4"> <!-- Aumentado el margen inferior -->
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4 form-check text-center"> <!-- Centrado del checkbox -->
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Recordarme') }}
                            </label>
                        </div>

                        <div class="d-flex justify-content-center mb-0"> <!-- Centrado del botón -->
                            <button type="submit" class="btn btn-primary" style="width: 100%; background-color: #007bff; border: none;">
                                {{ __('Iniciar Sesión') }}
                            </button>
                        </div>

                        <div class="text-center mt-3"> <!-- Espacio entre el botón y el enlace de contraseña -->
                            <a href="{{ route('password.request') }}" style="color: #007bff;">¿Olvidaste tu contraseña?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection