@extends('layouts.master')

@section('title', 'Listado de actores')

@section('header')
    @parent()
@endsection

@section('content')
    <h1 class="mt-3">{{$title}}</h1>

    @if(empty($actors) || count($actors) == 0)
        <FONT COLOR="red">No se ha encontrado ningún actor</FONT>
    @else
        <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    {{-- @foreach($actors as $actor)
                        @foreach(array_keys($actor) as $key)
                            <th>{{$key}}</th>
                        @endforeach
                        @break
                    @endforeach --}}
                    <th class="text-center align-middle">ID</th>
                    <th class="text-center align-middle">Nombre</th>
                    <th class="text-center align-middle">Apellido</th>
                    <th class="text-center align-middle">Fecha de nacimiento</th>
                    <th class="text-center align-middle">País</th>
                    <th class="text-center align-middle">Imagen</th>
                    <th class="text-center align-middle">Creación:</th>
                    <th class="text-center align-middle">Última actualización:</th>
                </tr>

            <tbody>
                @foreach($actors as $actor)
                    <tr>
                        <td>{{$actor['id']}}</td>
                        <td>{{$actor['name']}}</td>
                        <td>{{$actor['surname']}}</td>
                        <td>{{$actor['birthdate']}}</td>
                        <td>{{$actor['country']}}</td>
                        <td><img src={{$actor['img_url']}} class="img-fluid" style="width: 100px; heigth: 120px;" alt="Imagen de actor"/></td>
                        <td>{{$actor['created_at']}}</td>
                        <td>{{$actor['updated_at']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
@endsection
