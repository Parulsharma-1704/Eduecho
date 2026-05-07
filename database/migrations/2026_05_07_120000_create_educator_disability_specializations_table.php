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
        Schema::create('educator_disability_specializations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('educator_id')->constrained('special_educators')->onDelete('cascade');
            $table->enum('disability_type', ['autism', 'adhd', 'dyslexia', 'hearing', 'visual', 'mobility']);
            $table->boolean('is_certified')->default(false);
            $table->integer('years_of_experience')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Prevent duplicate specializations per educator
            $table->unique(['educator_id', 'disability_type'], 'edu_disability_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educator_disability_specializations');
    }
};
