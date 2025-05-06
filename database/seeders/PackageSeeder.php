<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('packages')->insert([
            [
                'name' => 'Privéles 2,5 uur',
                'description' => 'Inclusief alle materialen. Eén persoon per les. 1 dagdeel.',
                'price' => 175.00,
                'max_participants' => 1,
                'duration_hours' => 2.5,
                'sessions' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Duo Kiteles 3,5 uur',
                'description' => 'Inclusief alle materialen. Maximaal 2 personen per les. 1 dagdeel.',
                'price' => 135.00,
                'max_participants' => 2,
                'duration_hours' => 3.5,
                'sessions' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Duo Lespakket 3 lessen',
                'description' => 'Inclusief materialen. Maximaal 2 personen per les. 3 dagdelen.',
                'price' => 375.00,
                'max_participants' => 2,
                'duration_hours' => 10.5,
                'sessions' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Duo Lespakket 5 lessen',
                'description' => 'Inclusief materialen. Maximaal 2 personen per les. 5 dagdelen.',
                'price' => 675.00,
                'max_participants' => 2,
                'duration_hours' => 17.5,
                'sessions' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
