<?php

namespace Database\Seeders;

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
        $faker = Faker::create();

        // elimina los datos existentes en la tabla films_actors
        DB::table('films_actors')->truncate(); // truncate elimina registros de la tabla y reinicia contador autoincremental

        $film_ids = DB::table('films')->pluck('id');
        $actor_ids = DB::table('actors')->pluck('id');

        for($i = 0; $i < 3; $i++) {
            DB::table('films_actors')->insert([
                'film_id' => $faker->randomElement($film_ids),
                'actor_id'=> $faker->randomElement($actor_ids),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
