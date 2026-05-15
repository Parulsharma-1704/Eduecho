<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function specialEducator()
    {
        return $this->hasOne(SpecialEducator::class);
    }

    public function therapist()
    {
        return $this->hasOne(Therapist::class);
    }

    public function careGiver()
    {
        return $this->hasOne(CareGiver::class);
    }

    public function supportStaff()
    {
        return $this->hasOne(SupportStaff::class);
    }

    public function createdCourses()
    {
        return $this->hasMany(Course::class, 'created_by_id');
    }

    public function createdIEPs()
    {
        return $this->hasMany(IEP::class, 'created_by_id');
    }

    public function therapySessions()
    {
        return $this->hasMany(TherapySession::class, 'therapist_id');
    }

    public function behavioralNotes()
    {
        return $this->hasMany(BehavioralNote::class, 'created_by_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function complianceLogs()
    {
        return $this->hasMany(ComplianceLog::class);
    }

    public function accessibilityAudits()
    {
        return $this->hasMany(AccessibilityAudit::class, 'auditor_id');
    }

    public function progressReports()
    {
        return $this->hasMany(ProgressReport::class, 'generated_by_id');
    }
}
