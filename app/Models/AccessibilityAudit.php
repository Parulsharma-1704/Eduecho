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
        'issues_found' => 'array',
        'recommendations' => 'array',
    ];

    public function auditor()
    {
        return $this->belongsTo(User::class, 'auditor_id');
    }

    /**
     * Get compliance status
     */
    public function getComplianceStatus()
    {
        if ($this->status === 'compliant') {
            return ['label' => 'Compliant', 'color' => 'emerald', 'icon' => '✓'];
        } elseif ($this->status === 'partial') {
            return ['label' => 'Partial Compliance', 'color' => 'amber', 'icon' => '⚠️'];
        } else {
            return ['label' => 'Non-Compliant', 'color' => 'red', 'icon' => '✗'];
        }
    }

    /**
     * Get issues count
     */
    public function getIssuesCount()
    {
        $issues = $this->issues_found ?? [];
        return is_array($issues) ? count($issues) : 0;
    }

    /**
     * Get WCAG level label
     */
    public function getWCAGLabel()
    {
        return match($this->wcag_level) {
            'A' => 'WCAG 2.1 Level A',
            'AA' => 'WCAG 2.1 Level AA',
            'AAA' => 'WCAG 2.1 Level AAA',
            default => $this->wcag_level ?? 'Unknown',
        };
    }

    /**
     * Check if audit needs follow-up
     */
    public function needsFollowUp()
    {
        return $this->status !== 'compliant' || $this->getIssuesCount() > 0;
    }
}
