<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TherapySession extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'therapist_id',
        'session_type',
        'session_date',
        'duration',
        'notes',
        'progress',
    ];

    protected $casts = [
        'session_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapist_id');
    }

    public function behavioralNotes()
    {
        return $this->hasMany(BehavioralNote::class);
    }

    // Methods for progress tracking
    public function getProgressPercentage()
    {
        if (!$this->progress) {
            return 0;
        }
        
        // Parse progress as percentage (0-100)
        return is_numeric($this->progress) ? (int)$this->progress : 0;
    }

    public function getProgressStatus()
    {
        $percentage = $this->getProgressPercentage();
        
        if ($percentage >= 80) {
            return ['label' => 'Excellent', 'color' => 'emerald'];
        } elseif ($percentage >= 60) {
            return ['label' => 'Good', 'color' => 'blue'];
        } elseif ($percentage >= 40) {
            return ['label' => 'Fair', 'color' => 'amber'];
        } else {
            return ['label' => 'Needs Improvement', 'color' => 'red'];
        }
    }

    public function getSessionDurationFormatted()
    {
        if (!$this->duration) {
            return '0 min';
        }
        
        if ($this->duration >= 60) {
            $hours = intdiv($this->duration, 60);
            $mins = $this->duration % 60;
            return $mins > 0 ? "{$hours}h {$mins}m" : "{$hours}h";
        }
        
        return "{$this->duration} min";
    }

    public function getTherapyTypeLabel()
    {
        return match($this->session_type) {
            'speech' => 'Speech Therapy',
            'occupational' => 'Occupational Therapy',
            'physical' => 'Physical Therapy',
            'behavioral' => 'Behavioral Therapy',
            'counseling' => 'Counseling',
            'special_education' => 'Special Education Support',
            default => ucfirst($this->session_type),
        };
    }

    public function isCompleted()
    {
        return $this->session_date && $this->session_date->isPast();
    }

    public function isScheduled()
    {
        return $this->session_date && $this->session_date->isFuture();
    }
}