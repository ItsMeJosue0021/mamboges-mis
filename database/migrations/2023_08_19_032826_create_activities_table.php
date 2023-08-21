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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('max_score');
            $table->foreignId('evaluation_criteria_id')->constrained('evaluation_criterias')->onDelete('cascade');
            $table->foreignId('class_record_id')->constrained('class_records')->onDelete('cascade')->nullable(); // reserved for future use
            // $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade')->nullable(); // reserved for future use
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
