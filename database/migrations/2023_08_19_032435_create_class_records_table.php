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
        Schema::create('class_records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->foreignId('section_subject_id')->constrained('section_subjects')->onDelete('cascade')->nullable(); //reserved for future use
            // $table->foreignId('faculty_id')->constrained('faculties')->onDelete('cascade')->nullable(); //reserved for future use
            // $table->foreignId('school_year_id')->constrained('school_years')->onDelete('cascade')->nullable(); //reserved for future use
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_records');
    }
};
