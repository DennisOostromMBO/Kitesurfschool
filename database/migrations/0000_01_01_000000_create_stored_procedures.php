<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS UpdateUserProfile');

        DB::unprepared('
            CREATE PROCEDURE UpdateUserProfile(
                IN userId INT,
                IN userName VARCHAR(255),
                IN userAddress VARCHAR(255),
                IN userCity VARCHAR(255),
                IN userDOB DATE,
                IN userMobile VARCHAR(15)
            )
            BEGIN
                UPDATE users
                SET name = userName,
                    address = userAddress,
                    city = userCity,
                    date_of_birth = userDOB,
                    mobile = userMobile
                WHERE id = userId;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS UpdateUserProfile');
    }
};
