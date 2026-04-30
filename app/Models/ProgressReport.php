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
}
