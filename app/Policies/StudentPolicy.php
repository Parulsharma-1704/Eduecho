<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;

class StudentPolicy
{
    /**
     * Determine whether the user can view any students.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_students');
    }

    /**
     * Determine whether the user can view the student.
     */
    public function view(User $user, Student $student): bool
    {
        if ($user->can('view_students')) {
            // Students can only view their own profile
            if ($user->hasRole('student') && $user->student->id === $student->id) {
                return true;
            }
            // Others with permission can view
            return !$user->hasRole('student');
        }
        return false;
    }

    /**
     * Determine whether the user can create students.
     */
    public function create(User $user): bool
    {
        return $user->can('create_students');
    }

    /**
     * Determine whether the user can update the student.
     */
    public function update(User $user, Student $student): bool
    {
        if ($user->can('edit_students')) {
            // Students can only edit their own profile
            if ($user->hasRole('student') && $user->student->id === $student->id) {
                return true;
            }
            // Educators and admins can edit
            return $user->hasAnyRole(['special_educator', 'admin']);
        }
        return false;
    }

    /**
     * Determine whether the user can delete the student.
     */
    public function delete(User $user, Student $student): bool
    {
        return $user->can('delete_students') && $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the student.
     */
    public function restore(User $user, Student $student): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the student.
     */
    public function forceDelete(User $user, Student $student): bool
    {
        return $user->hasRole('admin');
    }
}
