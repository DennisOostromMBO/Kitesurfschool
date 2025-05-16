<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Test User (klant)
        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'klant',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Instructor User
        DB::table('users')->insert([
            'name' => 'Instructor',
            'email' => 'instructor@example.com',
            'role' => 'instructor',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call([
            PackageSeeder::class,
            PersonsSeeder::class,
            CustomersSeeder::class,
            ContactsSeeder::class,
            InstructorsSeeder::class,
            LocationsSeeder::class, 
            LessonsSeeder::class,
            PaymentsSeeder::class,
            ReservationsSeeder::class,
        ]);
    }
}
