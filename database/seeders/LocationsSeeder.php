<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            ['name' => 'Zandvoort', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Muiderberg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wijk aan Zee', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'IJmuiden', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Scheveningen', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hoek van Holland', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
