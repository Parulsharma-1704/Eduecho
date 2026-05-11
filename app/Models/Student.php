<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'enrollment_date',
        'is_active',
        'assigned_educator_id',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedEducator()
    {
        return $this->belongsTo(User::class, 'assigned_educator_id');
    }

    public function disabilityProfile()
    {
        return $this->hasOne(DisabilityProfile::class);
    }

    public function accessibilityProfile()
    {
        return $this->hasOne(AccessibilityProfile::class);
    }

    public function ieps()
    {
        return $this->hasMany(IEP::class);
    }

    public function courseEnrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function courses()
    {
        return $this->hasManyThrough(Course::class, CourseEnrollment::class);
    }

    public function therapySessions()
    {
        return $this->hasMany(TherapySession::class);
    }

    public function behavioralNotes()
    {
        return $this->hasMany(BehavioralNote::class);
    }

    public function assessmentResponses()
    {
        return $this->hasMany(AssessmentResponse::class);
    }

    public function progressReports()
    {
        return $this->hasMany(ProgressReport::class);
    }

    public function accommodationLogs()
    {
        return $this->hasMany(AccommodationLog::class);
    }

    public function careGivers()
    {
        return $this->belongsToMany(CareGiver::class, 'caregiver_student');
    }

    public function contentPreferences()
    {
        return $this->hasMany(StudentContentPreference::class);
    }
}
