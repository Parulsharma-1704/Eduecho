<?php

namespace App\Policies;

use App\Models\Assessment;
use App\Models\User;

class AssessmentPolicy
{
    /**
     * Determine whether the user can view any assessments.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_assessments');
    }

    /**
     * Determine whether the user can view the assessment.
     */
    public function view(User $user, Assessment $assessment): bool
    {
        return $user->hasPermissionTo('view_assessments');
    }

    /**
     * Determine whether the user can create assessments.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_assessments');
    }

    /**
     * Determine whether the user can update the assessment.
     */
    public function update(User $user, Assessment $assessment): bool
    {
        if ($user->hasPermissionTo('edit_assessments')) {
            return $user->hasRole(['special_educator', 'admin']);
        }
        return false;
    }

    /**
     * Determine whether the user can delete the assessment.
     */
    public function delete(User $user, Assessment $assessment): bool
    {
        if ($user->hasPermissionTo('delete_assessments')) {
            return $user->hasRole(['special_educator', 'admin']);
        }
        return false;
    }

    /**
     * Determine whether the user can restore the assessment.
     */
    public function restore(User $user, Assessment $assessment): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the assessment.
     */
    public function forceDelete(User $user, Assessment $assessment): bool
    {
        return $user->hasRole('admin');
    }
}
