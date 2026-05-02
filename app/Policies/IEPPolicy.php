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
        return $user->hasPermissionTo('view_ieps');
    }

    /**
     * Determine whether the user can view the IEP.
     */
    public function view(User $user, IEP $iep): bool
    {
        if ($user->hasPermissionTo('view_ieps')) {
            // Students can view their own IEP
            if ($user->hasRole('student') && $user->student->id === $iep->student_id) {
                return true;
            }
            // Educators, therapists, care givers can view
            return !$user->hasRole('student');
        }
        return false;
    }

    /**
     * Determine whether the user can create IEPs.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_ieps');
    }

    /**
     * Determine whether the user can update the IEP.
     */
    public function update(User $user, IEP $iep): bool
    {
        if ($user->hasPermissionTo('edit_ieps')) {
            // Only creator or admin can edit
            return $user->id === $iep->created_by_id || $user->hasRole('admin');
        }
        return false;
    }

    /**
     * Determine whether the user can delete the IEP.
     */
    public function delete(User $user, IEP $iep): bool
    {
        if ($user->hasPermissionTo('delete_ieps')) {
            return $user->id === $iep->created_by_id || $user->hasRole('admin');
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
