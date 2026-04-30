<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessibilityAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'auditor_id',
        'audit_date',
        'wcag_level',
        'issues_found',
        'recommendations',
        'status',
    ];

    protected $casts = [
        'audit_date' => 'date',
    ];

    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }
}
