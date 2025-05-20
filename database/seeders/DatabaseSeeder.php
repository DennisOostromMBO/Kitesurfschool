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
        // Create person for test user
        $testPersonId = DB::table('persons')->insertGetId([
            'first_name' => 'Test',
            'middle_name' => 'van',
            'last_name' => 'User',
            'date_of_birth' => '1990-01-01',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create customer record
        $testCustomerId = DB::table('customers')->insertGetId([
            'persons_id' => $testPersonId,
            'package_id' => null,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create contact for test user
        DB::table('contacts')->insert([
            'person_id' => $testPersonId,
            'customer_id' => $testCustomerId,
            'street_name' => 'Teststraat',
            'house_number' => '123',
            'postal_code' => '1234AB',
            'city' => 'Amsterdam',
            'mobile' => '0612345678',
            'email' => 'test@example.com',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create test user linked to person
        DB::table('users')->insert([
            'person_id' => $testPersonId,
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
