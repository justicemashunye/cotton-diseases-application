<?php

use App\Stage;
use Illuminate\Database\Seeder;

class StagesTableSeeder extends Seeder
{
   
    public function run()
    {
        //
        DB::table('stages')->insert([
            [
                'name' => 'Seedling Stage',
                'slug' => 'seedling-stage',
                'featured' => 1,
                'menu' => 0   
            ],
            [
                'name' => 'Bud Stage',
                'slug' => 'bud-stage',
                'featured' => 1,
                'menu' => 0   
            ],
            [
                'name' => 'Boll Stage',
                'slug' => 'boll-stage',
                'featured' => 0,
                'menu' => 0   
            ]
        ]);
    }
}
