<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportStaff extends Model
{
    use HasFactory;

    protected $table = 'support_staff';

    protected $fillable = [
        'user_id',
        'support_type',
        'qualifications',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
