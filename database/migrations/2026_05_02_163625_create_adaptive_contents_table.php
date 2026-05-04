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
        Schema::create('adaptive_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_resource_id')->constrained('course_resources')->cascadeOnDelete();
            $table->string('original_content')->nullable();
            $table->enum('content_type', ['text', 'video', 'audio', 'interactive', 'image', 'document']);
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced'])->default('intermediate');
            $table->foreignId('created_by_id')->constrained('users')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adaptive_contents');
    }
};
