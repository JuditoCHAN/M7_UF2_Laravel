@extends('layouts.master')

@section('title', 'Contador de actores')

@section('header')
    @parent()
@endsection

@section('content')
    <h1>{{$title}}</h1>

    @if($numActors == 0)
        <FONT COLOR="red">No se ha encontrado ninguna actor</FONT>
    @else
        <div>
            <p>Hay {{ $numActors }} actores registrados.</p>
        </div>
    @endif
@endsection
