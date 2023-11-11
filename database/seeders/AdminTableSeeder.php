<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name'               => 'Admin',
                'email'              => 'admin@app.com',
                'phone'              => '012345678',
                'password'           => Hash::make('123456'),
            ]
        ]);
    }
}
