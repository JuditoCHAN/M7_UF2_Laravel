<h1>{{$title}}</h1>

@if($numFilms == 0)
    <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
@else
    <div>
        <p>Hay {{ $numFilms }} películas registradas.</p>
    </div>
@endif