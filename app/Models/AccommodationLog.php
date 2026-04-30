<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccommodationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_resource_id',
        'accommodation_used',
        'duration',
        'timestamp',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function courseResource()
    {
        return $this->belongsTo(CourseResource::class, 'course_resource_id');
    }
}
