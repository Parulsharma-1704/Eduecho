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
        Schema::create('student_content_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('variation_id')->constrained('adaptive_content_variations', 'id')->cascadeOnDelete();
            $table->boolean('is_preferred')->default(true);
            $table->integer('usage_count')->default(0);
            $table->dateTime('last_used_at')->nullable();
            $table->timestamps();
            $table->unique(['student_id', 'variation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_content_preferences');
    }
};
