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
        Schema::table('course_resources', function (Blueprint $table) {
            $table->string('disability_category')->nullable()->after('description');
            $table->string('accessibility_support_type')->nullable()->after('disability_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_resources', function (Blueprint $table) {
            $table->dropColumn(['disability_category', 'accessibility_support_type']);
        });
    }
};
