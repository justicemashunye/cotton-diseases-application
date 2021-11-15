<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
   
    public function run()
    {
        //
        DB::table('locations')->insert([
            [
                'name' => 'Cotyledon ',
                'stage_id' => 1,
                'description' => "infancy"  
            ],
            [
                'name' => 'Stem',
                'stage_id' => 1,
                'description' => "stem"  
            ],
            [
                'name' => 'Leaf',
                'stage_id' => 3,
                'description' => "Leaf"  
            ],
            [
                'name' => 'Boll',
                'stage_id' => 2,
                'description' => "White Bolls"  
            ],
        ]);
    }
}
