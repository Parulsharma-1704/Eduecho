<?php

namespace App\Policies;

use App\Models\IEP;
use App\Models\User;

class IEPPolicy
{
    /**
     * Determine whether the user can view any IEPs.
     */
    public function viewAny(User $user): bool
    {
        try {
            return $user->hasPermissionTo('view_ieps') || $user->hasRole('admin');
        } catch (\Throwable $e) {
            return $user->hasAnyRole(['admin', 'student', 'special_educator', 'therapist', 'care_giver']);
        }
    }

    /**
     * Determine whether the user can view the IEP.
     */
    public function view(User $user, IEP $iep): bool
    {
        try {
            if ($user->hasPermissionTo('view_ieps') || $user->hasRole('admin')) {
                if ($user->hasRole('student') && $user->student && $user->student->id === $iep->student_id) {
                    return true;
                }
                return !$user->hasRole('student');
            }
        } catch (\Throwable $e) {
            if ($user->hasAnyRole(['admin', 'student', 'special_educator', 'therapist', 'care_giver'])) {
                if ($user->hasRole('student') && $user->student && $user->student->id === $iep->student_id) {
                    return true;
                }
                return !$user->hasRole('student');
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create IEPs.
     */
    public function create(User $user): bool
    {
        try {
            return $user->hasPermissionTo('create_ieps') || $user->hasRole('admin');
        } catch (\Throwable $e) {
            return $user->hasAnyRole(['admin', 'special_educator']);
        }
    }

    /**
     * Determine whether the user can update the IEP.
     */
    public function update(User $user, IEP $iep): bool
    {
        try {
            if ($user->hasPermissionTo('edit_ieps') || $user->hasRole('admin')) {
                return $user->id === $iep->created_by_id || $user->hasRole('admin');
            }
        } catch (\Throwable $e) {
            if ($user->hasAnyRole(['admin', 'special_educator'])) {
                return $user->id === $iep->created_by_id || $user->hasRole('admin');
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the IEP.
     */
    public function delete(User $user, IEP $iep): bool
    {
        try {
            if ($user->hasPermissionTo('delete_ieps') || $user->hasRole('admin')) {
                return $user->id === $iep->created_by_id || $user->hasRole('admin');
            }
        } catch (\Throwable $e) {
            if ($user->hasAnyRole(['admin', 'special_educator'])) {
                return $user->id === $iep->created_by_id || $user->hasRole('admin');
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the IEP.
     */
    public function restore(User $user, IEP $iep): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the IEP.
     */
    public function forceDelete(User $user, IEP $iep): bool
    {
        return $user->hasRole('admin');
    }
}
