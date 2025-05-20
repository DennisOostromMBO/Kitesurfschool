<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                'person_id' => 1, // Add this line
                'customer_id' => 1,
                'street_name' => 'Main Street',
                'house_number' => '123',
                'addition' => null,
                'postal_code' => '1234AB',
                'city' => 'Amsterdam',
                'mobile' => '0612345678',
                'email' => 'john.doe@example.com',
                'is_active' => true,
                'note' => 'Primary contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 2, // Add this line
                'customer_id' => 2,
                'street_name' => 'Second Avenue',
                'house_number' => '456',
                'addition' => 'A',
                'postal_code' => '5678CD',
                'city' => 'Rotterdam',
                'mobile' => '0698765432',
                'email' => 'jane.smith@example.com',
                'is_active' => false,
                'note' => 'Secondary contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 3, // Add this line
                'customer_id' => null, // No customer for instructors
                'street_name' => 'Unknown',
                'house_number' => '0',
                'addition' => null,
                'postal_code' => '0000AA',
                'city' => 'Unknown',
                'mobile' => '0612345678',
                'email' => 'duco.veenstra@example.com',
                'is_active' => true,
                'note' => 'Instructor contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 4, // Add this line
                'customer_id' => null, // No customer for instructors
                'street_name' => 'Unknown',
                'house_number' => '0',
                'addition' => null,
                'postal_code' => '0000AA',
                'city' => 'Unknown',
                'mobile' => '0623456789',
                'email' => 'waldemar.vandongen@example.com',
                'is_active' => true,
                'note' => 'Instructor contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 5, // Add this line
                'customer_id' => null, // No customer for instructors
                'street_name' => 'Unknown',
                'house_number' => '0',
                'addition' => null,
                'postal_code' => '0000AA',
                'city' => 'Unknown',
                'mobile' => '0634567890',
                'email' => 'ruud.terlingen@example.com',
                'is_active' => true,
                'note' => 'Instructor contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 6, // Add this line
                'customer_id' => null, // No customer for instructors
                'street_name' => 'Unknown',
                'house_number' => '0',
                'addition' => null,
                'postal_code' => '0000AA',
                'city' => 'Unknown',
                'mobile' => '0645678901',
                'email' => 'saskia.brink@example.com',
                'is_active' => true,
                'note' => 'Instructor contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 7, // Add this line
                'customer_id' => null, // No customer for instructors
                'street_name' => 'Unknown',
                'house_number' => '0',
                'addition' => null,
                'postal_code' => '0000AA',
                'city' => 'Unknown',
                'mobile' => '0656789012',
                'email' => 'bernie.vredenstein@example.com',
                'is_active' => true,
                'note' => 'Instructor contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
