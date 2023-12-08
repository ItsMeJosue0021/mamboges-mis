<?php

use App\Models\Faculty;
use App\Models\Quarter;
use App\Models\SchoolYear;
use App\Models\SectionSubjects;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_records', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('subject')->nullable();
            $table->string('grade')->nullable();
            $table->string('section')->nullable();
            $table->foreignIdFor(SectionSubjects::class)->constrained()->onDelete('cascade')->nullable();
            $table->foreignIdFor(Faculty::class)->constrained()->onDelete('cascade')->nullable();
            $table->foreignIdFor(SchoolYear::class)->constrained()->onDelete('cascade')->nullable();
            $table->foreignIdFor(Quarter::class)->constrained()->onDelete('cascade')->nullable();
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
