<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{

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


    public function destroy($id) {
        try {
            $actorDeleted = DB::table('actors')->where('id', $id)->delete(); // devuelve true si se elimina al menos una fila

            if ($actorDeleted) {
                return response()->json([
                    'action' => 'delete',
                    'status' => true
                ], 200); // código 200 -> petición exitosa
            } else {
                return response()->json([
                    'action' => 'delete',
                    'status' => false
                ], 200); // código 200 -> aunque no se haya eliminado nada
            }
        } catch (\Exception $e) {
            return response()->json([
                'action' => 'delete',
                'status' => false,
                'error' => $e->getMessage()
            ], 500); // código 500 -> error en el servidor
        }
    }
}
