<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageInstructorsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('package_instructors')->insert([
            [
                'package_id' => 1,
                'instructor_id' => 1, // Duco
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 2,
                'instructor_id' => 2, // Waldemar
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 3,
                'instructor_id' => 3, // Ruud
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 4,
                'instructor_id' => 4, // Saskia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'package_id' => 4,
                'instructor_id' => 5, // Bernie
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
