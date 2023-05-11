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
        Schema::create('class_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id');
            $table->integer('activity_number')->default(0);
            $table->foreignId('sectionsubject_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_evaluations');
    }
};
