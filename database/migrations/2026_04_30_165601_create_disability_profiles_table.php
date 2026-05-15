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
        if (!Schema::hasTable('disability_profiles')) {
            Schema::create('disability_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->unique()->constrained('students')->onDelete('cascade');
            $table->string('disability_type'); // Visual, Hearing, Motor, Cognitive, Multiple
            $table->string('severity'); // Mild, Moderate, Severe
            $table->longText('description')->nullable();
            $table->longText('medical_history')->nullable();
            $table->longText('medication_info')->nullable();
            $table->longText('support_devices')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disability_profiles');
    }
};
