<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->unique();
            $table->string('name_prefix')->nullable();
            $table->string('first_name')->nullable();
            $table->char('middle_initial', 1)->nullable();
            $table->string('last_name')->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('email')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->time('time_of_birth')->nullable();
            $table->float('age_in_years', 4, 2, true)->nullable();
            $table->date('date_of_joining')->nullable();
            $table->float('age_in_company', 4, 2, true)->nullable();
            $table->string('phone_no')->nullable();
            $table->string('place_name')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('region')->nullable();
            $table->string('username')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
