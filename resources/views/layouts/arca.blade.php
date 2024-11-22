<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Arca</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap CSS (optional, if not included globally) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Estilos personalizados */
        .navbar {
            background-color: #0F2E5F; /* Color de fondo de la navbar */
        }
        .navbar .navbar-nav .nav-link {
            color: white; /* Color de texto para los enlaces */
            font-weight: 600;
        }
        .navbar .navbar-nav .nav-link:hover {
            color: #ffd700; /* Color al pasar el ratón */
        }
        .navbar .navbar-brand {
            color: white; /* Color del nombre de la app */
           
        }
        .navbar .navbar-toggler-icon {
            background-color: white; /* Color del icono de menú en móviles */
        }
        .nav-item .bi-person {
            font-size: 2rem; /* Tamaño más grande para el icono */
            color: white; /* Color del icono */
        }
        .nav-item .bi-person:hover {
            color: #ffd700; /* Cambio de color al pasar el ratón */
        }
        .dropdown-menu {
            background-color: #007bff; /* Fondo del dropdown */
            border-radius: 0.25rem;
        }
        .dropdown-item {
            color: white; /* Color de los elementos en el dropdown */
        }
        .dropdown-item:hover {
            background-color:#0000ff; /* Fondo al pasar el ratón */
        }
        /* Alineación a la izquierda de los enlaces */
        .navbar-nav {
            margin-left: 0; /* Asegura que los enlaces estén alineados a la izquierda */
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" style="font-size: 2rem;" href="{{ url('/arca') }}">
                [A̲̅][r̲̅][c̲̅][a̲̅]
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Enlaces añadidos alineados a la izquierda -->
                        <li class="navbar-brand">
        <a class="nav-link" href="{{ route('arca') }}">Ofertas laborales</a>
    </li>
    <li class="navbar-brand">
        <a class="nav-link" href="{{ route('arcalaboral') }}">Información laboral</a>
    </li>
    <li class="navbar-brand">
        <a class="nav-link" href="{{ route('infopersonal') }}">Información Personal</a>
    </li>

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        @if(Auth::user() && Auth::user()->imagen)
            <img src="data:image/jpeg;base64,{{ base64_encode(Auth::user()->imagen) }}" alt="Imagen de usuario" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
        @else
        <img src="https://green.excertia.com/wp-content/uploads/2020/04/perfil-empty.png" alt="Imagen de usuario" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
       
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <span class="dropdown-item ">
            {{ Auth::user()->name }}
        </span>
        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editImageModal">
            Editar Imagen
        </a>
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            {{ __('Salir') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</li>


                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


 <!-- Modal para subir imagen -->
        <div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editImageModalLabel">Subir Imagen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <form action="{{ route('user.updateImage', ['user' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="mb-3">
                               
                                <label for="imagen">Cargar Imagen:</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" onchange="previewImage(event)" required>
                <img id="imagePreview" src="#" alt="Vista previa de la imagen" class="mt-3" style="display: none; max-width: 80px; height: auto;">
            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS (optional, if not included globally) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
