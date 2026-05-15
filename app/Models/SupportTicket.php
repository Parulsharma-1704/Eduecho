<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'student_id',
        'title',
        'description',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
