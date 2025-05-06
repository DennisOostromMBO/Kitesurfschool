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
        ]);
    }
}
