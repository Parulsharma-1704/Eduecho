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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('support_type')->nullable()->after('target_disabilities');
            $table->foreignId('assigned_educator_id')->nullable()->after('created_by_id')->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['assigned_educator_id']);
            $table->dropColumn(['support_type', 'assigned_educator_id']);
        });
    }
};
