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

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }
}
