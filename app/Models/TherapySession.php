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
}
