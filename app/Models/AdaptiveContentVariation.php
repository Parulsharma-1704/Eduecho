<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdaptiveContentVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'adaptive_content_id',
        'variation_type',
        'target_disability',
        'adapted_content',
        'accessibility_features',
        'is_default',
        'recommendation_score',
        'description',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'accessibility_features' => 'array',
    ];

    // Relationships
    public function adaptiveContent()
    {
        return $this->belongsTo(AdaptiveContent::class);
    }

    public function studentPreferences()
    {
        return $this->hasMany(StudentContentPreference::class, 'variation_id');
    }

    public function students()
    {
        return $this->hasManyThrough(
            Student::class,
            StudentContentPreference::class,
            'variation_id',
            'id',
            'id',
            'student_id'
        );
    }

    // Methods
    public function getAccessibilityFeaturesArray()
    {
        return $this->accessibility_features ?? [];
    }

    public function hasAccessibilityFeature($feature)
    {
        return in_array($feature, $this->getAccessibilityFeaturesArray());
    }

    public function incrementUsageCount()
    {
        $this->usage_count = ($this->usage_count ?? 0) + 1;
        $this->save();
    }

    public function recordUsage()
    {
        $this->update([
            'usage_count' => ($this->usage_count ?? 0) + 1,
            'last_used_at' => now(),
        ]);
    }
}

