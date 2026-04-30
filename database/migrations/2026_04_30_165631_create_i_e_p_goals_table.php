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
        Schema::create('i_e_p_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iep_id')->constrained('i_e_p_s')->onDelete('cascade');
            $table->string('goal_type'); // Academic, Behavioral, Therapy
            $table->longText('goal_description');
            $table->date('target_date')->nullable();
            $table->string('status')->default('In Progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_e_p_goals');
    }
};
