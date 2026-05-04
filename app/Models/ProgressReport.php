<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgressReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'period',
        'academic_progress',
        'behavioral_progress',
        'therapy_progress',
        'accessibility_recommendations',
        'overall_summary',
        'generated_by_id',
        'generated_at',
    ];

    protected $casts = [
        'generated_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function generatedBy()
    {
        return $this->belongsTo(User::class, 'generated_by_id');
    }

    public function getAverageProgress()
    {
        $scores = [];
        if ($this->academic_progress) $scores[] = (int)$this->academic_progress;
        if ($this->behavioral_progress) $scores[] = (int)$this->behavioral_progress;
        if ($this->therapy_progress) $scores[] = (int)$this->therapy_progress;
        
        return count($scores) > 0 ? round(array_sum($scores) / count($scores)) : 0;
    }

    public function getOverallStatus()
    {
        $avg = $this->getAverageProgress();
        
        if ($avg >= 80) {
            return ['label' => 'Excellent Progress', 'color' => 'emerald'];
        } elseif ($avg >= 60) {
            return ['label' => 'Good Progress', 'color' => 'blue'];
        } elseif ($avg >= 40) {
            return ['label' => 'Moderate Progress', 'color' => 'amber'];
        } else {
            return ['label' => 'Needs Support', 'color' => 'red'];
        }
    }
}
