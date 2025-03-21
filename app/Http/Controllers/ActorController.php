<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readActors(): array {
        $films = Storage::json('/public/films.json');
        try {
            $filmsDB = DB::table('films')->get()->toArray(); // devuelve array de objetos stdClass
        } catch (\Exception $e) {
            $filmsDB = null;
        }

        $filmsDBInArray = null;
        // hay que convertir $filmsDB en un array asociativo
        if($filmsDB != null) {
            foreach($filmsDB as $film) {
                $filmsDBInArray[] = (array) $film;
            }
        }

        // si no hay datos en la base de datos o no hay conexión, devolvemos solo los datos del fichero ($films)
        return isset($films) && isset($filmsDBInArray) ? ($films + $filmsDBInArray) : $films;
    }


    /**
     * List films older than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
        $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }


    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }


    /**
     * Lista TODOS los actores o filtra x década.
     */
    public function listActors($decade = null)
    {
        $title = "Listado de todos los actores";
        try {
            $actors = DB::table('actors')->get()->toArray(); // devuelve array de objetos stdClass
        } catch (\Exception $e) {
            $actors = [];
        }

        // hay que convertir $actors (array de stdClass) en un array asociativo
        $actorsDBInArray = [];
        foreach($actors as $actor) {
            $actorsDBInArray[] = (array) $actor;
        }

        //if parameter decade is null
        if (is_null($decade))
            return view('actors.list', ["actors" => $actorsDBInArray, "title" => $title]);

        //list based on year or genre informed
        // foreach ($films as $film) {
        //     if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
        //         $title = "Listado de todas las pelis filtrado x año";
        //         $films_filtered[] = $film;
        //     }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
        //         $title = "Listado de todas las pelis filtrado x categoria";
        //         $films_filtered[] = $film;
        //     }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
        //         $title = "Listado de todas las pelis filtrado x categoria y año";
        //         $films_filtered[] = $film;
        //     }
        // }
        // return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }


    public function listFilmsByGenre($genre = null) {
        $films_filtered = [];
        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if genre is null
        if (is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on genre
        foreach ($films as $film) {
            if (strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }


    public function listFilmsByYear($year = null) {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year is null
        if (is_null($year))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year
        foreach ($films as $film) {
            if ($film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }


    public function sortFilms() {
        $title = "Listado de todas las pelis en orden descendiente";
        $films = FilmController::readFilms();

        usort($films, function($a, $b) {
            return $b['year'] - $a['year']; //si da positivo, es q el año de $b es mayor
        });

        return view("films.list", ["films" => $films, "title" => $title]);
    }


    public function countActors() {
        $title = "Número total de actores";
        $numActors = DB::table('actors')->count();

        return view("actors.count", ["title" => $title, "numActors" => $numActors]);
    }


    public static function isFilm($filmName): bool {
        $films = FilmController::readFilms();

        foreach($films as $film) {
            if($film['name'] === $filmName) { //si ya hay una peli con ese nombre
                return true;
            }
        }
        return false; //no hay pelis con ese nombre
    }


    public function createFilm(Request $request) {
        $films = FilmController::readFilms();

        $newFilm =[
            'name' => $request->input("name"),
            'year' => $request->input("year"),
            'genre' => $request->input("genre"),
            'country' => $request->input("country"),'duration' => $request->input("duration"),'img_url' => $request->input("img_url")
        ];

        // si ya existe una película con ese nombre
        if(FilmController::isFilm($newFilm['name'])) {
            return view("welcome", ["status" => "Ya existe una película con ese nombre"]);
        } else {
            // TODO: Verificamos el valor de la flag desde el archivo de configuración film.php
            $insertInDB = config('film.insert_in_db');

            if($insertInDB) {
                // añadimos la peli a la base de datos
                try {
                    DB::table('films')->insert($newFilm);
                    return redirect()->action('App\Http\Controllers\FilmController@listFilms');
                } catch(\Exception $e) {
                    return view("welcome", ["status" => "Error al añadir la peli a la base de datos: " . $e->getMessage()]);
                }

            } else {
                try {
                    // añadimos la peli al fichero JSON
                    $films[] = $newFilm;
                    $status = Storage::put('/public/films.json', json_encode($films));

                    if($status) {
                        return redirect()->action('App\Http\Controllers\FilmController@listFilms');
                    } else {
                        return view("welcome", ["status" => "Error al añadir la peli al fichero"]);
                    }
                } catch(\Exception $e) {
                    return view("welcome", ["status" => "Error al añadir la peli al fichero: " . $e->getMessage()]);
                }
            }
        }
    }
}
