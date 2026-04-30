<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BehavioralNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'created_by_id',
        'observation_date',
        'observation',
        'emotion_state',
        'support_provided',
    ];

    protected $casts = [
        'observation_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
