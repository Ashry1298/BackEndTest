<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $customers = [];
        for ($i = 0; $i < 10; $i++) {
            $customers[] = [
                'name'         => $faker->name,
                'phone'        => "51831111$i",
                'email'        => $faker->unique()->email,
                'password'     => bcrypt('123456'),

            ];
        }
        DB::table('customers')->insert($customers);
    }
}
