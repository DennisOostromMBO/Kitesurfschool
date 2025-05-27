<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeslotsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('timeslots')->insert([
            [
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'display_name' => 'Ochtend (09:00 - 12:00)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'start_time' => '13:00:00',
                'end_time' => '16:00:00',
                'display_name' => 'Middag (13:00 - 16:00)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'start_time' => '16:30:00',
                'end_time' => '19:30:00',
                'display_name' => 'Namiddag (16:30 - 19:30)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
