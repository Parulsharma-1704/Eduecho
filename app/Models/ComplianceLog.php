<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplianceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'action_type',
        'details',
        'timestamp',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get action type icon and color
     */
    public function getActionTypeInfo()
    {
        return match($this->action_type) {
            'data_access' => ['label' => 'Data Access', 'color' => 'blue', 'icon' => '👁️'],
            'data_modification' => ['label' => 'Data Modified', 'color' => 'orange', 'icon' => '✏️'],
            'data_deletion' => ['label' => 'Data Deleted', 'color' => 'red', 'icon' => '🗑️'],
            'user_created' => ['label' => 'User Created', 'color' => 'green', 'icon' => '👤'],
            'access_granted' => ['label' => 'Access Granted', 'color' => 'emerald', 'icon' => '🔓'],
            'access_denied' => ['label' => 'Access Denied', 'color' => 'red', 'icon' => '🔒'],
            'export' => ['label' => 'Data Exported', 'color' => 'purple', 'icon' => '📤'],
            'audit' => ['label' => 'Audit', 'color' => 'slate', 'icon' => '📋'],
            default => ['label' => ucfirst(str_replace('_', ' ', $this->action_type)), 'color' => 'slate', 'icon' => '📝'],
        };
    }

    /**
     * Get readable action description
     */
    public function getActionDescription()
    {
        $userName = $this->user?->name ?? 'System';
        return "{$userName} - {$this->action}";
    }

    /**
     * Check if action is sensitive
     */
    public function isSensitiveAction()
    {
        return in_array($this->action_type, [
            'data_deletion',
            'access_denied',
            'user_created',
            'access_granted',
            'export'
        ]);
    }
}
