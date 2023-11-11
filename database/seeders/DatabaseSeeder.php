<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        $this->call(AdminTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
    }
}
