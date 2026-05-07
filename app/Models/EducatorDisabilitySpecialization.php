<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducatorDisabilitySpecialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'educator_id',
        'disability_type',
        'is_certified',
        'years_of_experience',
        'notes',
    ];

    protected $casts = [
        'is_certified' => 'boolean',
    ];

    public function educator()
    {
        return $this->belongsTo(SpecialEducator::class);
    }
}
