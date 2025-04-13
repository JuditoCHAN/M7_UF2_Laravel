@extends('layouts.master')

@section('title', 'Contador de peliculas')

@section('header')
    @parent()
@endsection

@section('content')
    <div class="container mt-5 rounded py-3 form-custom">
        <h2 class="pb-3">{{$title}}</h2>

        @if($numFilms == 0)
            <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
        @else
            <div>
                <p>Hay {{ $numFilms }} películas registradas.</p>
            </div>
        @endif
    </div>
@endsection
