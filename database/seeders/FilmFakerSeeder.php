<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // desactivar (temporalmente) las restricciones de claves foráneas para poder hacer truncate
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // elimina los datos existentes en la tabla films:
        // truncate elimina registros de la tabla y reinicia contador autoincremental
        //DB::table('films')->truncate();

        $ratings = ['G', 'PG', 'PG-13', 'R', 'NC-17'];
        $genres = ['thriller', 'action', 'drama', 'love'];

        foreach (range(1, 10) as $index) {
            DB::table('films')->insert([
                'name' => $faker->sentence(3),
                'year' => $faker->year,
                'genre' => $faker->randomElement($genres),
                'country' => $faker->country,
                'rating' => $faker->randomElement($ratings),
                'duration' => $faker->numberBetween(90, 180),
                'img_url' => $faker->imageUrl(640, 480, 'movies'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
