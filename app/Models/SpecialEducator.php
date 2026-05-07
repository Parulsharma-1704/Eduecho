<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecialEducator extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'qualification',
        'experience_years',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function createdCourses()
    {
        return $this->hasManyThrough(Course::class, User::class, 'id', 'created_by_id', 'user_id', 'id');
    }

    public function createdIEPs()
    {
        return $this->hasManyThrough(IEP::class, User::class, 'id', 'created_by_id', 'user_id', 'id');
    }

    public function disabilitySpecializations()
    {
        return $this->hasMany(EducatorDisabilitySpecialization::class, 'educator_id');
    }

    public function studentsWithDisabilities()
    {
        return Student::whereHas('disabilityProfile', function($query) {
            $query->whereIn('disability_type', 
                $this->disabilitySpecializations()->pluck('disability_type')
            );
        })->get();
    }
}
