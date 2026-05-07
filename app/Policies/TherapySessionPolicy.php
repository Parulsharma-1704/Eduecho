<?php

namespace App\Policies;

use App\Models\TherapySession;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TherapySessionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'therapist', 'student', 'care_giver']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TherapySession $therapySession): bool
    {
        if ($user->hasRole('admin')) return true;
        if ($user->hasRole('therapist')) return $therapySession->therapist_id === $user->id;
        if ($user->hasRole('student')) return $therapySession->student_id === $user->student?->id;
        if ($user->hasRole('care_giver')) {
            return $therapySession->student->careGivers()
                ->where('users.id', $user->id)
                ->exists();
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'therapist']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TherapySession $therapySession): bool
    {
        if ($user->hasRole('admin')) return true;
        if ($user->hasRole('therapist')) return $therapySession->therapist_id === $user->id;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TherapySession $therapySession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TherapySession $therapySession): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TherapySession $therapySession): bool
    {
        return false;
    }
}
