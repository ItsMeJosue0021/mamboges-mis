<?php

use App\Models\DownloadableFilesGroup;
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
        Schema::create('downloadable_files', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('fileName');
            $table->foreignIdFor(DownloadableFilesGroup::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloadable_files');
    }
};
