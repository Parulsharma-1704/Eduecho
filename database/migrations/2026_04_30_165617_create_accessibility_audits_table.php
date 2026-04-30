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
        Schema::create('accessibility_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auditor_id')->constrained('users')->onDelete('cascade');
            $table->date('audit_date');
            $table->string('wcag_level'); // A, AA, AAA
            $table->longText('issues_found')->nullable();
            $table->longText('recommendations')->nullable();
            $table->string('status'); // Pending, In Progress, Complete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessibility_audits');
    }
};
