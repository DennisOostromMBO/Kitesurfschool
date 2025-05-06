<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'persons_id' => 1,
                'package_id' => 1, 
                'is_active' => true,
                'note' => 'Regular customer with a package',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'persons_id' => 2,
                'package_id' => null, 
                'is_active' => false,
                'note' => 'Inactive customer without a package',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
