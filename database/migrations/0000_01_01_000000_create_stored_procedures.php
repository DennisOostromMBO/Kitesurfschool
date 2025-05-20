<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS SPUpdateUserProfile');
        
        // Read and execute the stored procedure files
        $spUpdateUserProfile = file_get_contents(database_path('SP/Users/SPUpdateUserProfile.sql'));
        DB::unprepared($spUpdateUserProfile);
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS SPUpdateUserProfile');
    }
};
