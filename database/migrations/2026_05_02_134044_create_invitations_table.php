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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('role'); // educator, therapist, care_giver, support_staff, admin
            $table->string('token')->unique(); // Secure token for invitation link
            $table->foreignId('invited_by')->constrained('users')->cascadeOnDelete(); // Admin who created invitation
            $table->timestamp('used_at')->nullable(); // When the invitation was used
            $table->timestamp('expires_at')->nullable(); // When invitation expires
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
