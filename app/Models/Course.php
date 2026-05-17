<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'created_by_id',
        'assigned_educator_id',
        'accessibility_level',
        'target_disabilities',
        'support_type',
        'max_students',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function assignedEducator()
    {
        return $this->belongsTo(User::class, 'assigned_educator_id');
    }

    public function resources()
    {
        return $this->hasMany(CourseResource::class, 'course_id');
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class, 'course_id');
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, CourseEnrollment::class, 'course_id', 'id', 'id', 'student_id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'course_id');
    }
}
