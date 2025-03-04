<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // desactivar (temporalmente) las restricciones de claves foráneas para poder hacer truncate
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // elimina los datos existentes en la tabla actors:
        // truncate elimina registros de la tabla y reinicia contador autoincremental
        //DB::table('actors')->truncate();

        foreach (range(1, 10) as $index) {
            DB::table('actors')->insert([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'birthdate' => $faker->date('Y-m-d'),
                'country' => $faker->country,
                'img_url' => $faker->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
