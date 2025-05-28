<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Add owner user at the start
        DB::table('users')->insert([
            [
                'name' => 'Eigenaar',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'eigenaar',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('users')->insert([
            [
                'person_id' => 4,
                'name' => 'Duco',
                'email' => 'duco.veenstra@example.com',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 5,
                'name' => 'Waldemar',
                'email' => 'waldemar.vandongen@example.com',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 6,
                'name' => 'Ruud',
                'email' => 'ruud.terlingen@example.com',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 7,
                'name' => 'Saskia',
                'email' => 'saskia.brink@example.com',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 8,
                'name' => 'Bernie',
                'email' => 'bernie.vredenstein@example.com',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
