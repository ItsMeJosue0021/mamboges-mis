<?php

use App\Models\ClassRecordEvaluationCriteria;
use App\Models\Student;
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
        Schema::create('activity_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ClassRecordEvaluationCriteria::class)->constrained()->cascadeOnDelete();
            $table->integer('total');
            $table->decimal('ps', 5, 2)->default(0);
            $table->decimal('ws', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_statistics');
    }
};
