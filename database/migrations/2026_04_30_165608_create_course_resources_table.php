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
        Schema::create('course_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->string('resource_type'); // Text, Audio, Video, PDF, Sign-Language
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('file_path')->nullable();
            $table->boolean('has_captions')->default(false);
            $table->boolean('has_transcript')->default(false);
            $table->boolean('has_audio_description')->default(false);
            $table->boolean('text_size_options')->default(false);
            $table->boolean('high_contrast_version')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_resources');
    }
};
