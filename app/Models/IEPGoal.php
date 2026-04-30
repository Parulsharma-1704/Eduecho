<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IEPGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'iep_id',
        'goal_type',
        'goal_description',
        'target_date',
        'status',
    ];

    protected $casts = [
        'target_date' => 'date',
    ];

    public function iep()
    {
        return $this->belongsTo(IEP::class, 'iep_id');
    }
}
