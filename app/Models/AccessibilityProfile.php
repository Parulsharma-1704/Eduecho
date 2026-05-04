<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    protected $casts = [
        'high_contrast' => 'boolean',
        'invert_colors' => 'boolean',
        'text_to_speech' => 'boolean',
        'screen_reader_mode' => 'boolean',
        'voice_control' => 'boolean',
        'keyboard_only' => 'boolean',
        'reading_guide' => 'boolean',
        'focus_mode' => 'boolean',
        'font_size' => 'integer',
        'line_spacing' => 'float',
        'letter_spacing' => 'float',
    ];

    /**
     * Get the student this accessibility profile belongs to
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get font size classes for CSS
     */
    public function getFontSizeClass(): string
    {
        return match($this->font_size) {
            12 => 'text-xs',
            14 => 'text-sm',
            16 => 'text-base',
            18 => 'text-lg',
            20 => 'text-xl',
            24 => 'text-2xl',
            default => 'text-base'
        };
    }

    /**
     * Get color scheme classes
     */
    public function getColorSchemeClasses(): array
    {
        if ($this->invert_colors) {
            return [
                'bg' => 'bg-slate-950',
                'text' => 'text-yellow-100',
            ];
        }

        if ($this->high_contrast) {
            return [
                'bg' => 'bg-black',
                'text' => 'text-white',
            ];
        }

        return [
            'bg' => 'bg-white dark:bg-slate-900',
            'text' => 'text-slate-900 dark:text-white',
        ];
    }

    /**
     * Get line spacing value in CSS units
     */
    public function getLineSpacingValue(): string
    {
        return $this->line_spacing . 'em';
    }

    /**
     * Get letter spacing value in CSS units
     */
    public function getLetterSpacingValue(): string
    {
        return ($this->letter_spacing * 0.1) . 'em';
    }

    /**
     * Get font family for CSS
     */
    public function getFontFamilyClass(): string
    {
        return match($this->font_family) {
            'Dyslexia' => 'font-dyslexia',
            'Serif' => 'font-serif',
            'Monospace' => 'font-mono',
            'Roboto' => 'font-sans',
            default => 'font-sans'
        };
    }
}
