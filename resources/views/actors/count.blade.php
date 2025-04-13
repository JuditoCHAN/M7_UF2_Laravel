@extends('layouts.master')

@section('title', 'Contador de actores')

@section('header')
    @parent()
@endsection

@section('content')
    <div class="container mt-5 rounded py-3 listing-custom">
        <h2 class="pb-3">{{$title}}</h2>

        @if($numActors == 0)
            <FONT COLOR="red">No se ha encontrado ningún actor</FONT>
        @else
            <div>
                <p>Hay {{ $numActors }} actores registrados.</p>
            </div>
        @endif
    </div>
@endsection
