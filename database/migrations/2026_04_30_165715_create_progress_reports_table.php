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
        Schema::create('progress_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('period'); // Monthly, Quarterly, Yearly
            $table->longText('academic_progress')->nullable();
            $table->longText('behavioral_progress')->nullable();
            $table->longText('therapy_progress')->nullable();
            $table->longText('accessibility_recommendations')->nullable();
            $table->longText('overall_summary')->nullable();
            $table->foreignId('generated_by_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('generated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_reports');
    }
};
