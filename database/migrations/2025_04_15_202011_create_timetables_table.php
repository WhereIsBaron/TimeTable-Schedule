<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->string('class_code');
            $table->string('instructor_name');
            $table->string('room');
            $table->string('day_of_week');   // e.g., Monday
            $table->string('start_time');    // e.g., 08:00 AM
            $table->string('end_time');      // e.g., 09:30 AM
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
