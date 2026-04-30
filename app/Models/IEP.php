<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IEP extends Model
{
    use HasFactory;

    protected $table = 'i_e_p_s';

    protected $fillable = [
        'student_id',
        'created_by_id',
        'status',
        'academic_goals',
        'behavioral_goals',
        'therapy_goals',
        'review_date',
        'notes',
    ];

    protected $casts = [
        'review_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function goals()
    {
        return $this->hasMany(IEPGoal::class, 'iep_id');
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class, 'iep_id');
    }
}
