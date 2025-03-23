@extends('layouts.master')

@section('title', 'Listado de peliculas')

@section('header')
    @parent()
@endsection

@section('content')
    <h1 class="mt-3">{{$title}}</h1>

    @if(empty($films))
        <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
    @else
        <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Año</th>
                    <th>Género</th>
                    <th>País</th>
                    <th>Duración</th>
                    <th>Imagen</th>
                </tr>
            </thead>

            <tbody>
                @foreach($films as $film)
                    <tr>
                        <td>{{$film['name']}}</td>
                        <td>{{$film['year']}}</td>
                        <td>{{$film['genre']}}</td>
                        <td>{{$film['country']}}</td>
                        <td>{{$film['duration']}}</td>
                        <td><img src={{$film['img_url']}} class="img-fluid" style="width: 100px; heigth: 120px;" alt="Imagen de película"/></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
@endsection
