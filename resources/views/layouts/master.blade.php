<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Peliculas')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Winky+Rough:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include any additional stylesheets or scripts here -->
    <style>
        .ul-styles {
            justify-content: center;
            align-items: center;
            gap: 40px;
        }

        .navbar-custom, .footer-custom {
            min-height: 4rem;
            background-color: #192A51;
            box-shadow: 5px 5px 5px lightblue;
        }

        body {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            background-color: #f5e6e860;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .form-custom {
            background-color: #aaa1c884;
        }

        .listing-custom {
            background-color: #d5c6e078;
        }

        .title-font {
            font-family: "Winky Rough", cursive;
            font-size: 2rem;
            color: #fff;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    @section('header')
    <header>
        <nav class="navbar navbar-expand-lg navbar-color-styles navbar-dark navbar-custom">
            <span class="navbar-brand">
                <a class="nav-link title-font" href="{{ route('welcome') }}">CINEMA APP</a>
            </span>

            <!-- Botón toggler para pantallas pequeñas -->
            <button class="navbar-toggler toggler-styles" type="button" data-toggle="collapse" data-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenedor colapsable del navbar -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ml-auto ul-styles">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('welcome') }}">INICIO</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">PELÍCULAS </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('listFilms') }}">Listado completo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('oldFilms') }}">Antiguas</a></li>
                            <li><a class="dropdown-item" href="{{ route('newFilms') }}">Nuevas</a></li>
                            <li><a class="dropdown-item" href="{{ route('sortFilms') }}">En orden descendiente</a></li>
                            <li><a class="dropdown-item" href="{{ route('countFilms') }}">Contador</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ACTORES </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('listActors') }}">Listado completo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('countActors') }}">Contador</a></li>
                        </ul>
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
    <footer class="text-light py-4 mt-4 footer-custom">
        <div class="container text-center">
            <h5 class="mb-2 title-font">CINEMA APP</h5>
            <p class="mb-2">© {{ date('Y') }} Todos los derechos reservados.</p>
            <div>
                <a href="#" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-light mx-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light mx-2"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->

</body>

</html>
