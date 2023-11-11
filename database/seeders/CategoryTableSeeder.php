<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name'              => 'First Category',
                'created_at'        => Carbon::now()
            ],
            [
                'name'              => 'Second Category',
                'created_at'        => Carbon::now()

            ],
            
        ]);
        DB::table('categories')->insert([
            [
                'parent_id'         => 1,
                'name'              => 'First SubCategory',
                'created_at'        => Carbon::now()

            ],
            [
                'parent_id'         => 1,
                'name'              => 'Second SubCategory',
                'created_at'        => Carbon::now()

            ],
            [
                'parent_id'         => 2,
                'name'              => 'Third SubCategory',
                'created_at'        => Carbon::now()
            ],
            [
                'parent_id'         => 2,
                'name'              => 'Fourth SubCategory',
                'created_at'        => Carbon::now()
            ],

        ]);
    }
}
