<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessibilityProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'font_size',
        'font_family',
        'line_spacing',
        'letter_spacing',
        'high_contrast',
        'invert_colors',
        'text_to_speech',
        'screen_reader_mode',
        'voice_control',
        'keyboard_only',
        'reading_guide',
        'focus_mode',
        'color_scheme',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
