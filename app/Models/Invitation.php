<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    protected $fillable = ['email', 'role', 'token', 'invited_by', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    /**
     * Get the user who created this invitation
     */
    public function invitedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    /**
     * Check if invitation is still valid (not expired and not used)
     */
    public function isValid(): bool
    {
        return $this->used_at === null && $this->expires_at > now();
    }

    /**
     * Mark invitation as used
     */
    public function markAsUsed(): void
    {
        $this->update(['used_at' => now()]);
    }

    /**
     * Generate a secure random token
     */
    public static function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }
}
