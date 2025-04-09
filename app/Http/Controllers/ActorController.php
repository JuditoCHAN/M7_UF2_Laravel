<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{

    /**
     * Lista TODOS los actores
     */
    public function listActors()
    {
        $title = "Listado de todos los actores";
        try {
            $actorsDB = Actor::all()->toArray();
        } catch (\Exception $e) {
            $actorsDB = [];
        }

        return view('actors.list', ["actors" => $actorsDB, "title" => $title]);
    }


    public function countActors() {
        $title = "Número total de actores";
        try {
            $numActors = Actor::count();
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
                $actorsDB = Actor::whereBetween('birthdate', ["$decadeStart-01-01", "$decadeEnd-12-31"])->get();
            } catch (\Exception $e) {
                $actorsDB = [];
            }

            return view('actors.list', ["actors" => $actorsDB, "title" => $title]);
        }
    }


    public function destroy($id) {
        try {
            $actor = Actor::find($id);
            if(!$actor) {
                return response()->json([
                    'action' => 'delete',
                    'status' => false,
                    'error' => 'Actor not found'
                ], 404); // código 404 -> no encontrado
            }

            $result = $actor->delete();
            if ($result) {
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


    public function index() {
        try {
            if(Actor::count() === 0) {
                return response()->json([
                    'action' => 'get',
                    'status' => 'no actors found'
                ], 200);
            }

            $actorsDB = Actor::all()->toArray();
        } catch (\Exception $e) {
            $actorsDB = ['action' => 'get actors', 'status' => 'error', 'error' => $e->getMessage()];
        }

        return response()->json($actorsDB, 200);
    }
}
