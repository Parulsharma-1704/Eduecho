<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssessmentResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'assessment_id',
        'student_id',
        'response_data',
        'score',
        'feedback',
        'time_taken',
        'used_extra_time',
        'completed_at',
    ];

    protected $casts = [
        'used_extra_time' => 'boolean',
        'completed_at' => 'datetime',
        'response_data' => 'array',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Get score percentage
     */
    public function getScorePercentage()
    {
        if (!$this->score) {
            return 0;
        }
        
        // Assuming score is already a percentage or calculate from total points
        return is_numeric($this->score) ? (int)$this->score : 0;
    }

    /**
     * Get performance status
     */
    public function getPerformanceStatus()
    {
        $percentage = $this->getScorePercentage();
        
        if ($percentage >= 80) {
            return ['label' => 'Excellent', 'color' => 'emerald', 'icon' => '🌟'];
        } elseif ($percentage >= 70) {
            return ['label' => 'Good', 'color' => 'blue', 'icon' => '👍'];
        } elseif ($percentage >= 60) {
            return ['label' => 'Satisfactory', 'color' => 'amber', 'icon' => '👌'];
        } else {
            return ['label' => 'Needs Improvement', 'color' => 'red', 'icon' => '📚'];
        }
    }

    /**
     * Get time taken formatted
     */
    public function getTimeTakenFormatted()
    {
        if (!$this->time_taken) {
            return 'Not recorded';
        }
        
        $minutes = intdiv($this->time_taken, 60);
        $seconds = $this->time_taken % 60;
        
        if ($minutes === 0) {
            return "{$seconds}s";
        }
        
        return "{$minutes}m {$seconds}s";
    }

    /**
     * Check if assessment was completed
     */
    public function isCompleted()
    {
        return $this->completed_at !== null;
    }

    /**
     * Check if time was exceeded
     */
    public function wasTimeExceeded()
    {
        if (!$this->assessment->time_limit || !$this->time_taken) {
            return false;
        }

        $limitSeconds = $this->assessment->time_limit * 60;
        return $this->time_taken > $limitSeconds;
    }
}
