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
        Schema::create('accessibility_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->unique()->constrained('students')->onDelete('cascade');
            $table->integer('font_size')->default(16);
            $table->string('font_family')->default('Roboto');
            $table->float('line_spacing')->default(1.5);
            $table->float('letter_spacing')->default(0);
            $table->boolean('high_contrast')->default(false);
            $table->boolean('invert_colors')->default(false);
            $table->boolean('text_to_speech')->default(false);
            $table->boolean('screen_reader_mode')->default(false);
            $table->boolean('voice_control')->default(false);
            $table->boolean('keyboard_only')->default(false);
            $table->boolean('reading_guide')->default(false);
            $table->boolean('focus_mode')->default(false);
            $table->string('color_scheme')->default('light');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessibility_profiles');
    }
};
