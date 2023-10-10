<?php

use App\Models\Faculty;
use App\Models\Section;
use App\Models\Subjects;
use App\Models\SchoolYear;
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
        Schema::create('section_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Section::class)->constrained();
            $table->foreignIdFor(Subjects::class)->constrained();
            $table->foreignIdFor(Faculty::class)->constrained();
            $table->foreignIdFor(SchoolYear::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_subjects');
    }
};
