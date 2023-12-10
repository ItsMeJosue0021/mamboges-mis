<?php

use App\Models\Quarter;
use App\Models\Student;
use App\Models\ClassRecord;
use App\Models\SchoolYear;
use App\Models\Section;
use App\Models\Subjects;
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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(ClassRecord::class);
            $table->foreignIdFor(Quarter::class);
            $table->foreignIdFor(Section::class);
            $table->foreignIdFor(Subjects::class);
            $table->foreignIdFor(SchoolYear::class);
            $table->string('remarks');
            $table->integer('grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
