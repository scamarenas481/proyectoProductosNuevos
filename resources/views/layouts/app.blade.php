<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>

    <!-- Estilos CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Scripts JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Mi Aplicación</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Inicio</a>
    </li>
    @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('selectRole') }}">Seleccionar Rol</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </li>

        @if (auth()->user()->activeRole && (auth()->user()->activeRole->name === 'Ventas'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('vendedor.home') }}">Inicio Vendedor</a>
            </li>
        @endif

        @if (auth()->user()->activeRole && (auth()->user()->activeRole->name === 'Administrador'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.home') }}">Inicio Admin</a>
            </li>
        @endif

        <li class="nav-item">
            <span class="navbar-text">Rol: {{ auth()->user()->activeRole->name }}</span>
        </li>
    @endauth
</ul>

            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
