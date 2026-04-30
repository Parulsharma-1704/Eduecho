<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Therapist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'certification',
        'experience_years',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function therapySessions()
    {
        return $this->hasManyThrough(TherapySession::class, User::class, 'id', 'therapist_id', 'user_id', 'id');
    }
}
