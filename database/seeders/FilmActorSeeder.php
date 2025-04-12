<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // desactivamos restricciones de claves foráneas, limpiamos tablas y reactivamos restricciones:
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::table('films_actors')->truncate();
        // DB::table('films')->truncate();
        // DB::table('actors')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // creamos 5 películas y 5 actores
        $films = Film::factory()->count(5)->create();
        $actors = Actor::factory()->count(5)->create();

        // asignamos entre 1 a 3 actores a cada película
        foreach ($films as $film) {
            $film->actors()->attach(
                $actors->random(rand(1, 3))->pluck('id')->toArray(),
                ['created_at' => now(), 'updated_at' => now()] // para que los timestamps no aparezcan vacíos
            );
        }
    }
}
