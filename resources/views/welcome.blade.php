@extends('layouts.master')

@section('title', 'Cinema App')

@section('header')
    @parent()
@endsection

@section('content')
    <div class="container mt-5 rounded py-3 listing-custom">
        <h2 class="pb-3">Lista de películas</h2>
        <ul>
            <li><a href=/filmout/oldFilms>Antiguas</a></li>
            <li><a href=/filmout/newFilms>Nuevas</a></li>
            <li><a href=/filmout/films>Listado completo</a></li>
            <li><a href=/filmout/sortFilms>Por año en orden descendiente</a></li>
            <li><a href=/filmout/countFilms>Contador de películas</a></li>
        </ul>
    </div>

    @if (!empty($status))
        <div class="alert alert-danger mt-5">
            {{ $status }}
        </div>
    @endif

    <div class="container mt-5 rounded py-3 form-custom">
        <h2 class="pb-3">Crear una película</h2>
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

    <div class="container mt-5 rounded py-3 listing-custom">
        <h2 class="pb-3">Lista de actores</h2>
        <ul>
            <li><a href=/actorout/actors>Listar actores</a></li>
            <li><a href=/actorout/countActors>Contar actores</a></li>
        </ul>
    </div>

    <div class="container mt-5 rounded py-3 form-custom">
        <form action="{{ route('listActorsByDecade')}}" method="GET">
            @csrf
            <h2 class="pb-3">Buscar actores por criterio</h2>
            <label for="decade" class="form-label">Década de nacimiento</label>
            <select name="year" id="decade" class="form-select ml-2" onchange="this.form.action='{{ route('listActorsByDecade', '') }}/' + this.value;" required>
                <option value="">Selecciona un año</option>
                <option value="1980" {{ request('year') == '1980' ? 'selected' : '' }}>1980-1989</option>
                <option value="1990" {{ request('year') == '1990' ? 'selected' : '' }}>1990-1999</option>
                <option value="2000" {{ request('year') == '2000' ? 'selected' : '' }}>2000-2009</option>
                <option value="2010" {{ request('year') == '2010' ? 'selected' : '' }}>2010-2019</option>
                <option value="2020" {{ request('year') == '2020' ? 'selected' : '' }}>2020-2029</option>
            </select>
            <button type="submit" class="btn btn-primary ml-3">Buscar</button>
        </form>
    </div>
@endsection

