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

        for($i = 0; $i < 3; $i++) {
            DB::table('films_actors')->insert([
                'film_id' => 1,
                'actor_id'=> $i + 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
