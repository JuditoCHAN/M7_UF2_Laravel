@extends('layouts.master')

@section('title', 'Cinema App')

@section('header')
    @parent()
@endsection

@section('content')
    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
        <li><a href=/filmout/films>Pelis</a></li>
        <li><a href=/filmout/sortFilms>Pelis por año en orden descendiente</a></li>
        <li><a href=/filmout/countFilms>Número total de pelis</a></li>
    </ul>

    <br>
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
                <input type="text" name="genre" id="genre" class="form-control" required>
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
@endsection

