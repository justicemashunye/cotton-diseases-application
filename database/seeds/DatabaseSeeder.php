<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(AdminsTableSeeder::class);
         //$this->call(SettingsTableSeeder::class);
         //$this->call(StagesTableSeeder::class);
         $this->call(LocationsTableSeeder::class);
    }
}
