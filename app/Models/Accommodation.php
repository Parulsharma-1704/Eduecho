<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'iep_id',
        'accommodation_type',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function iep()
    {
        return $this->belongsTo(IEP::class, 'iep_id');
    }
}
