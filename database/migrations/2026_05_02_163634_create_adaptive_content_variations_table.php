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
        Schema::create('adaptive_content_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adaptive_content_id')->constrained('adaptive_contents')->cascadeOnDelete();
            $table->enum('variation_type', ['simplified', 'detailed', 'visual', 'audio', 'kinesthetic', 'multimodal']);
            $table->enum('target_disability', ['hearing', 'visual', 'mobility', 'cognitive', 'learning', 'speech', 'multiple'])->nullable();
            $table->longText('adapted_content');
            $table->json('accessibility_features')->nullable();
            $table->boolean('is_default')->default(false);
            $table->integer('recommendation_score')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adaptive_content_variations');
    }
};
