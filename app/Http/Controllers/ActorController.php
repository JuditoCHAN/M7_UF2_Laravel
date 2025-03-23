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

        return view('actors.list', ["actors" => $actorsDBInArray, "title" => $title]);
    }


    public function countActors() {
        $title = "Número total de actores";
        try {
            $numActors = DB::table('actors')->count();
        } catch (\Exception $e) {
            $numActors = 0;
        }

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

    public function listActorsByDecade($year = null) {
        // si el parámetro $decade no está informado, devolvemos una vista que mostrará un mensaje
        if (is_null($year)) {
            $title = "Listado de actores";
            return view('actors.list', ["actors" => [], "title" => $title]);
        } else {
            $title = "Listado de actores de la década de los " . $year;
            $decadeStart = $year;
            $decadeEnd = $year + 9;

            try {
                $actors = DB::table('actors')
                ->whereBetween('birthdate', ["$decadeStart-01-01", "$decadeEnd-12-31"])
                ->get()
                ->toArray(); // devuelve array de objetos stdClass
            } catch (\Exception $e) {
                $actors = [];
            }

            // hay que convertir $actors (array de stdClass) en un array asociativo
            $actorsDBInArray = [];
            foreach($actors as $actor) {
                $actorsDBInArray[] = (array) $actor;
            }

            return view('actors.list', ["actors" => $actorsDBInArray, "title" => $title]);
        }
    }
}
