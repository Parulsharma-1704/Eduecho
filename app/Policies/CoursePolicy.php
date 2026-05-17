<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    /**
     * Determine whether the user can view any courses.
     */
    public function viewAny(User $user): bool
    {
        try {
            return $user->hasPermissionTo('view_courses') || $user->hasRole('admin');
        } catch (\Throwable $e) {
            return $user->hasAnyRole(['admin', 'student', 'special_educator', 'therapist']);
        }
    }

    /**
     * Determine whether the user can view the course.
     */
    public function view(User $user, Course $course): bool
    {
        try {
            return $user->hasPermissionTo('view_courses') || $user->hasRole('admin');
        } catch (\Throwable $e) {
            return $user->hasAnyRole(['admin', 'student', 'special_educator', 'therapist']);
        }
    }

    /**
     * Determine whether the user can create courses.
     */
    public function create(User $user): bool
    {
        try {
            return $user->hasPermissionTo('create_courses') || $user->hasRole('admin');
        } catch (\Throwable $e) {
            return $user->hasAnyRole(['admin', 'special_educator']);
        }
    }

    /**
     * Determine whether the user can update the course.
     */
    public function update(User $user, Course $course): bool
    {
        try {
            if ($user->hasPermissionTo('edit_courses') || $user->hasRole('admin')) {
                return $user->id === $course->created_by_id || $user->hasRole('admin');
            }
        } catch (\Throwable $e) {
            if ($user->hasAnyRole(['admin', 'special_educator'])) {
                return $user->id === $course->created_by_id || $user->hasRole('admin');
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the course.
     */
    public function delete(User $user, Course $course): bool
    {
        try {
            if ($user->hasPermissionTo('delete_courses') || $user->hasRole('admin')) {
                return $user->id === $course->created_by_id || $user->hasRole('admin');
            }
        } catch (\Throwable $e) {
            if ($user->hasAnyRole(['admin', 'special_educator'])) {
                return $user->id === $course->created_by_id || $user->hasRole('admin');
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the course.
     */
    public function restore(User $user, Course $course): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the course.
     */
    public function forceDelete(User $user, Course $course): bool
    {
        return $user->hasRole('admin');
    }
}
