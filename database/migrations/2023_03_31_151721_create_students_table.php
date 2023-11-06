<?php

use App\Models\User;
use App\Models\Guardian;
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

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('lrn');
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Guardian::class)->nullable();
            $table->boolean('isEnrolled')->default(false);
            $table->string('reasonForArchiving')->nullable();
            $table->string('lastSectionAttended')->nullable();
            $table->string('gradeLevelWhenArchived')->nullable();
            $table->integer('archivedBy')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
