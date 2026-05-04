<?php

namespace App\Policies;

use App\Models\AccessibilityAudit;
use App\Models\User;

class AccessibilityAuditPolicy
{
    /**
     * Determine whether the user can view any models
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'accessibility-specialist', 'auditor']);
    }

    /**
     * Determine whether the user can view the model
     */
    public function view(User $user, AccessibilityAudit $audit): bool
    {
        return $user->hasAnyRole(['admin', 'accessibility-specialist', 'auditor']);
    }

    /**
     * Determine whether the user can create models
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'auditor', 'accessibility-specialist']);
    }

    /**
     * Determine whether the user can update the model
     */
    public function update(User $user, AccessibilityAudit $audit): bool
    {
        return $user->hasAnyRole(['admin', 'auditor']);
    }

    /**
     * Determine whether the user can delete the model
     */
    public function delete(User $user, AccessibilityAudit $audit): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model
     */
    public function restore(User $user, AccessibilityAudit $audit): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model
     */
    public function forceDelete(User $user, AccessibilityAudit $audit): bool
    {
        return $user->hasRole('admin');
    }
}
