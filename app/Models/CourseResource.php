<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'resource_type',
        'title',
        'description',
        'file_path',
        'has_captions',
        'has_transcript',
        'has_audio_description',
        'text_size_options',
        'high_contrast_version',
        'disability_category',
        'accessibility_support_type',
    ];

    protected $casts = [
        'has_captions' => 'boolean',
        'has_transcript' => 'boolean',
        'has_audio_description' => 'boolean',
        'text_size_options' => 'boolean',
        'high_contrast_version' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function accommodationLogs()
    {
        return $this->hasMany(AccommodationLog::class, 'course_resource_id');
    }
}
