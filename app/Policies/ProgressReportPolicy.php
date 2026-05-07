<?php

namespace App\Policies;

use App\Models\ProgressReport;
use App\Models\User;

class ProgressReportPolicy
{
    /**
     * Determine whether the user can view any progress reports.
     */
    public function viewAny(User $user): bool
    {
        // Admins can view all
        if ($user->hasRole('admin')) {
            return true;
        }

        // Special educators can view
        if ($user->hasRole('special_educator')) {
            return true;
        }

        // Therapists can view
        if ($user->hasRole('therapist')) {
            return true;
        }

        // Care givers can view
        if ($user->hasRole('care_giver')) {
            return true;
        }

        // Students cannot view
        return false;
    }

    /**
     * Determine whether the user can view the progress report.
     */
    public function view(User $user, ProgressReport $progressReport): bool
    {
        // Admins can view all reports
        if ($user->hasRole('admin')) {
            return true;
        }

        // Special educators can view reports for their students
        if ($user->hasRole('special_educator')) {
            // If educator is assigned to the student
            return $progressReport->student->assigned_educator_id === $user->id;
        }

        // Therapists can view reports for their students
        if ($user->hasRole('therapist')) {
            // Check if therapist has worked with this student
            return $progressReport->student->therapySessions()
                ->where('therapist_id', $user->id)
                ->exists();
        }

        // Care givers can view reports for their monitored students
        if ($user->hasRole('care_giver')) {
            return $progressReport->student->careGivers()
                ->where('users.id', $user->id)
                ->exists();
        }

        // Students cannot view reports
        return false;
    }
}
