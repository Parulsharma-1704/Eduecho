<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdaptiveQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'question_text',
        'difficulty_level',
        'question_type',
        'options',
        'correct_answer',
        'points',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    /**
     * Get formatted options for display
     */
    public function getFormattedOptions()
    {
        if (is_string($this->options)) {
            return json_decode($this->options, true);
        }
        return $this->options ?? [];
    }

    /**
     * Check if answer is correct
     */
    public function isCorrect($answer)
    {
        $correct = is_string($this->correct_answer) ? 
            json_decode($this->correct_answer, true) : 
            $this->correct_answer;
        
        return $answer === $correct || (is_array($correct) && in_array($answer, $correct));
    }

    /**
     * Get difficulty level label
     */
    public function getDifficultyLabel()
    {
        return match($this->difficulty_level) {
            'easy' => '⭐ Easy',
            'medium' => '⭐⭐ Medium',
            'hard' => '⭐⭐⭐ Hard',
            default => ucfirst($this->difficulty_level),
        };
    }

    /**
     * Get question type label
     */
    public function getQuestionTypeLabel()
    {
        return match($this->question_type) {
            'multiple_choice' => 'Multiple Choice',
            'short_answer' => 'Short Answer',
            'essay' => 'Essay',
            'true_false' => 'True/False',
            'matching' => 'Matching',
            'fill_blank' => 'Fill in the Blank',
            default => ucfirst(str_replace('_', ' ', $this->question_type)),
        };
    }
}
