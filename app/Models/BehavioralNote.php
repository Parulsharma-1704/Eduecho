<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BehavioralNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'created_by_id',
        'observation_date',
        'observation',
        'emotion_state',
        'support_provided',
    ];

    protected $casts = [
        'observation_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getEmotionStateColor()
    {
        return match($this->emotion_state) {
            'happy' => 'emerald',
            'calm' => 'blue',
            'anxious' => 'amber',
            'frustrated' => 'orange',
            'angry' => 'red',
            'sad' => 'slate',
            default => 'slate',
        };
    }

    public function getEmotionStateIcon()
    {
        return match($this->emotion_state) {
            'happy' => '😊',
            'calm' => '😌',
            'anxious' => '😰',
            'frustrated' => '😤',
            'angry' => '😠',
            'sad' => '😢',
            default => '😐',
        };
    }
}
