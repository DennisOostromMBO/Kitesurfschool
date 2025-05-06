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
        ]);
    }
}
