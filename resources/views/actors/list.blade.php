@extends('layouts.master')

@section('title', 'Listado de actores')

@section('header')
    @parent()
@endsection

@section('content')
    <h1>{{$title}}</h1>

    @if(empty($actors) || count($actors) == 0)
        <FONT COLOR="red">No se ha encontrado ningún actor</FONT>
    @else
        <div align="center">
        <table border="1">
            <tr>
                @if(!empty($actors))
                    @foreach($actors as $actor)
                        @foreach(array_keys($actor) as $key)
                            <th>{{$key}}</th>
                        @endforeach
                        @break
                    @endforeach

                    @foreach($actors as $actor)
                        <tr>
                            <td>{{$actor['id']}}</td>
                            <td>{{$actor['name']}}</td>
                            <td>{{$actor['surname']}}</td>
                            <td>{{$actor['birthdate']}}</td>
                            <td>{{$actor['country']}}</td>
                            <td><img src={{$actor['img_url']}} style="width: 100px; heigth: 120px;" /></td>
                            <td>{{$actor['created_at']}}</td>
                            <td>{{$actor['updated_at']}}</td>
                        </tr>
                    @endforeach
                @endif
        </table>
    </div>
    @endif
@endsection
