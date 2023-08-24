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
        Schema::create('class_record_evaluation_criterias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('percentage')->default(0); 
            $table->foreignId('class_record_id')->references('id')->on('class_records')->onDelete('cascade');
            $table->foreignId('evaluation_criteria_id')->references('id')->on('evaluation_criterias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_record_evaluation_criterias');
    }
};
