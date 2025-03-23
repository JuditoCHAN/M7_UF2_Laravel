@extends('layouts.master')

@section('title', 'Cinema App')

@section('header')
    @parent()
@endsection

@section('content')
    <h1 class="mt-4">Lista de películas</h1>
    <ul>
        <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
        <li><a href=/filmout/films>Pelis</a></li>
        <li><a href=/filmout/sortFilms>Pelis por año en orden descendiente</a></li>
        <li><a href=/filmout/countFilms>Contar películas</a></li>
    </ul>
    <hr>

    @if (!empty($status))
        <div class="alert alert-danger">
            {{ $status }}
        </div>
    @endif

    <div class="container mt-5">
        <h2>Crea una película</h2>
        <form action="{{ route('createFilm') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre: </label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Año: </label>
                <input type="number" name="year" id="year" min="1930" max="2025" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Género: </label>
                <select name="genre" id="genre" class="form-select" required>
                    <option value="thriller">Thriller</option>
                    <option value="action">Action</option>
                    <option value="drama">Drama</option>
                    <option value="love">Love</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">País: </label>
                <input type="text" name="country" id="country" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duración: </label>
                <input type="number" name="duration" id="duration" min="60" max="300" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="img_url" class="form-label">Url imagen: </label>
                <input type="text" name="img_url" id="img_url" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary my-3">Crear película</button>
        </form>
    </div>
    <hr>

    <div class="container mt-5">
        <h2>Lista de actores</h2>
        <li><a href=/actorout/actors>Listar actores</a></li>
        <li><a href=/actorout/countActors>Contar actores</a></li>
    </div>
    <hr>

    <div class="container mt-5">
        <form action="{{ route('listActorsByDecade')}}" method="GET">
            @csrf
            <h2>Buscar actores por criterio</h2>
            <label for="decade" class="form-label">Década de nacimiento</label>
            <select name="year" id="decade" class="form-select ml-2" onchange="this.form.action='{{ route('listActorsByDecade', '') }}/' + this.value;">
                <option value="">Selecciona un año</option>
                <option value="1980" {{ request('year') == '1980' ? 'selected' : '' }}>1980-1989</option>
                <option value="1990" {{ request('year') == '1990' ? 'selected' : '' }}>1990-1999</option>
                <option value="2000" {{ request('year') == '2000' ? 'selected' : '' }}>2000-2009</option>
                <option value="2010" {{ request('year') == '2010' ? 'selected' : '' }}>2010-2019</option>
                <option value="2020" {{ request('year') == '2020' ? 'selected' : '' }}>2020-2029</option>
            </select>
            <button type="submit" class="btn btn-primary my-3 ml-3">Buscar</button>
        </form>
    </div>
@endsection

