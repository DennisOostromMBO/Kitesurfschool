<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('persons')->insert([
            [
                'first_name' => 'John',
                'middle_name' => 'van',
                'last_name' => 'Doe',
                'date_of_birth' => '1990-01-01',
                'is_active' => true,
                'note' => 'First test person',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jane',
                'middle_name' => null,
                'last_name' => 'Smith',
                'date_of_birth' => '1985-05-15',
                'is_active' => true,
                'note' => 'Second test person',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Duco',
                'middle_name' => null,
                'last_name' => 'Veenstra',
                'date_of_birth' => '1980-01-01',
                'is_active' => true,
                'note' => 'Instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Waldemar',
                'middle_name' => 'van',
                'last_name' => 'Dongen',
                'date_of_birth' => '1985-02-15',
                'is_active' => true,
                'note' => 'Instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ruud',
                'middle_name' => null,
                'last_name' => 'Terlingen',
                'date_of_birth' => '1990-03-20',
                'is_active' => true,
                'note' => 'Instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Saskia',
                'middle_name' => null,
                'last_name' => 'Brink',
                'date_of_birth' => '1992-04-25',
                'is_active' => true,
                'note' => 'Instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Bernie',
                'middle_name' => null,
                'last_name' => 'Vredenstein',
                'date_of_birth' => '1988-05-30',
                'is_active' => true,
                'note' => 'Instructor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
