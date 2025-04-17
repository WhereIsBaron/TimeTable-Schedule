<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('faculty_class_code', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Faculty Admin
            $table->foreignId('master_timetable_id')->constrained()->onDelete('cascade');
            $table->string('class_code'); // Should match class_code in Timetables table
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faculty_class_code');
    }
};