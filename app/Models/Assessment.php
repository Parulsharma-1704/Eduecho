<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'is_adaptive',
        'time_limit',
        'allow_extra_time',
        'allow_breaks',
        'allow_assistive_tech',
    ];

    protected $casts = [
        'is_adaptive' => 'boolean',
        'allow_extra_time' => 'boolean',
        'allow_breaks' => 'boolean',
        'allow_assistive_tech' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function questions()
    {
        return $this->hasMany(AdaptiveQuestion::class, 'assessment_id');
    }

    public function responses()
    {
        return $this->hasMany(AssessmentResponse::class, 'assessment_id');
    }

    /**
     * Get questions adapted for a specific student
     */
    public function getAdaptedQuestionsForStudent(Student $student)
    {
        $questions = $this->questions()->get();
        
        if (!$this->is_adaptive || !$student->disabilityProfile) {
            return $questions;
        }
        
        // Filter questions based on difficulty and disability type
        $disability = $student->disabilityProfile;
        return $questions->filter(function($question) use ($disability) {
            // Adapt question difficulty based on cognitive disabilities
            if (in_array('cognitive', json_decode($disability->disability_types ?? '[]', true))) {
                return $question->difficulty_level === 'easy' || $question->difficulty_level === 'medium';
            }
            return true;
        });
    }

    /**
     * Get accessibility accommodations for a student
     */
    public function getAccommodationsForStudent(Student $student)
    {
        if (!$student->accessibilityProfile) {
            return [];
        }

        $accommodations = [];
        if ($this->allow_extra_time && $student->accessibilityProfile->extra_time_percentage) {
            $accommodations['extra_time'] = $student->accessibilityProfile->extra_time_percentage;
        }
        if ($this->allow_breaks) {
            $accommodations['allow_breaks'] = true;
        }
        if ($this->allow_assistive_tech) {
            $accommodations['allow_assistive_tech'] = true;
        }

        return $accommodations;
    }

    /**
     * Calculate adjusted time limit for student
     */
    public function getAdjustedTimeLimit(Student $student)
    {
        if (!$this->time_limit) {
            return null;
        }

        $accommodations = $this->getAccommodationsForStudent($student);
        if (isset($accommodations['extra_time'])) {
            return (int)($this->time_limit * (1 + ($accommodations['extra_time'] / 100)));
        }

        return $this->time_limit;
    }

    /**
     * Get average score for this assessment
     */
    public function getAverageScore()
    {
        return $this->responses()->avg('score') ?? 0;
    }

    /**
     * Get completion rate
     */
    public function getCompletionRate()
    {
        $total = $this->responses()->count();
        if ($total === 0) return 0;
        
        $completed = $this->responses()->whereNotNull('completed_at')->count();
        return round(($completed / $total) * 100);
    }
}
