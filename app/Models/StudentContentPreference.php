<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentContentPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'variation_id',
        'is_preferred',
        'usage_count',
        'last_used_at',
    ];

    protected $casts = [
        'is_preferred' => 'boolean',
        'last_used_at' => 'datetime',
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function variation()
    {
        return $this->belongsTo(AdaptiveContentVariation::class, 'variation_id');
    }

    public function adaptiveContent()
    {
        return $this->hasOneThrough(
            AdaptiveContent::class,
            AdaptiveContentVariation::class,
            'id',
            'id',
            'variation_id',
            'adaptive_content_id'
        );
    }

    // Methods
    public function updateUsage()
    {
        $this->update([
            'usage_count' => ($this->usage_count ?? 0) + 1,
            'last_used_at' => now(),
        ]);
    }

    public function togglePreference()
    {
        $this->update(['is_preferred' => !$this->is_preferred]);
    }
}

