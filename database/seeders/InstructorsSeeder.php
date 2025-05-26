<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('instructors')->insert([
            [
                'person_id' => 4, // Duco Veenstra
                'contact_id' => 4, // Contact for Duco
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 5, // Waldemar van Dongen
                'contact_id' => 5, // Contact for Waldemar
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 6, // Ruud Terlingen
                'contact_id' => 6, // Contact for Ruud
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 7, // Saskia Brink
                'contact_id' => 7, // Contact for Saskia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 8, // Bernie Vredenstein
                'contact_id' => 8, // Contact for Bernie
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
