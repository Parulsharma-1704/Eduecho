<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdaptiveContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_resource_id',
        'original_content',
        'content_type',
        'difficulty_level',
        'created_by_id',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function courseResource()
    {
        return $this->belongsTo(CourseResource::class, 'course_resource_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function variations()
    {
        return $this->hasMany(AdaptiveContentVariation::class);
    }

    public function studentPreferences()
    {
        return $this->hasManyThrough(
            StudentContentPreference::class,
            AdaptiveContentVariation::class,
            'adaptive_content_id',
            'variation_id'
        );
    }

    // Methods
    public function getDefaultVariation()
    {
        return $this->variations()->where('is_default', true)->first() ?? $this->variations()->first();
    }

    public function getVariationForStudent(Student $student)
    {
        $disability = $student->disabilityProfile;
        $accessibility = $student->accessibilityProfile;

        if (!$disability) {
            return $this->getDefaultVariation();
        }

        // Match variation by disability type
        $variation = $this->variations()
            ->where('target_disability', $disability->disability_type)
            ->orWhere('target_disability', 'multiple')
            ->orderBy('recommendation_score', 'desc')
            ->first();

        if (!$variation && $accessibility) {
            // Fall back to accessibility-based recommendation
            if ($accessibility->text_to_speech) {
                $variation = $this->variations()->where('variation_type', 'audio')->first();
            } elseif ($accessibility->high_contrast || $accessibility->invert_colors) {
                $variation = $this->variations()->where('variation_type', 'visual')->first();
            }
        }

        return $variation ?? $this->getDefaultVariation();
    }
}

