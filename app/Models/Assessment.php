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
}
