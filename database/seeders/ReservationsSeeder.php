<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservations')->insert([
            [
                'user_id' => 1,
                'package_id' => 1, // Ensure this package exists in the packages table
                'instructor_id' => null, // Set to null since instructors are not implemented
                'contact_id' => 2, // Set to null if no contact exists
                'location' => 'Beach A',
                'lesson_date' => '2024-06-01',
                'status' => 'confirmed',
                'reason' => null,
                'is_paid' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'package_id' => 2, // Ensure this package exists in the packages table
                'instructor_id' => null, // Set to null since instructors are not implemented
                'contact_id' => 2, // Set to null if no contact exists
                'location' => 'Beach B',
                'lesson_date' => '2024-06-15',
                'status' => 'pending',
                'reason' => null,
                'is_paid' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
