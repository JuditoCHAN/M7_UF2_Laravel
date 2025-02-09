<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Peliculas')</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include any additional stylesheets or scripts here -->
    <style>
        .ul-styles {
            justify-content: center;
            align-items: center;
            gap: 40px;
        }

        .navbar-color-styles {
            background: rgb(252,255,191);
            background: linear-gradient(90deg, rgba(252,255,191,1) 7%, rgba(255,234,190,1) 39%, rgba(255,195,195,1) 88%);
            border: 1px solid orange;
        }
    </style>
</head>

<body>

    @section('header')
    <header>
        {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto navbar-styles">
                    <li><img src="{{ asset('img/img_header.png') }}" alt="Icono de cine" class="img-fluid" style="max-height: 60px;"></li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('welcome') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listFilms') }}">Pelis</a>
                    </li>
                </ul>
            </div>
        </nav> --}}

        <nav class="navbar navbar-expand-lg navbar-color-styles navbar-light">
            <img src="{{ asset('img/img_header.png') }}" alt="Icono de cine" class="img-fluid" style="max-height: 70px; margin-right: 20px;">
            <span class="navbar-brand">CinemaApp</span>

            <!-- Botón toggler para pantallas pequeñas -->
            <button class="navbar-toggler toggler-styles" type="button" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenedor colapsable del navbar -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mr-auto ul-styles">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('welcome') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listFilms') }}">Pelis</a>
                    </li>
                </ul>
            </div>
        </nav>

    </header>
    @show


    <main class="container">
        @yield('content')
    </main>

    <!-- Footer estático (no como el header) siempre se añadirá y no se puede modificar/ampliar en plantillas hijas-->
    <footer class="bg-light py-3 mt-4">
        <div class="container text-center">
            <img src="{{ asset('img/footer.png') }}" alt="Imagen de una entrada de cine con información de la app" class="img-fluid">
        </div>
    </footer>

    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

</body>

</html>
