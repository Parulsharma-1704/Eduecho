<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisabilityProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'disability_type',
        'severity',
        'description',
        'medical_history',
        'medication_info',
        'support_devices',
        'emergency_contact',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
