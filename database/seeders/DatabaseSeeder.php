<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Maak een testgebruiker aan met een gehasht wachtwoord
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'), // Stel hier het wachtwoord in
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
