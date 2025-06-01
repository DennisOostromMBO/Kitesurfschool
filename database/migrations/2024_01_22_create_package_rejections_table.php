<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('package_rejections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_package_id')->constrained('user_packages')->onDelete('cascade');
            $table->text('reason');
            $table->enum('status', ['pending', 'approved', 'denied'])->default('pending');
            $table->text('instructor_response')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('package_rejections');
    }
};
