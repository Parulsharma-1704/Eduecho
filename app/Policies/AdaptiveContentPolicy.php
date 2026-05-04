<?php

namespace App\Policies;

use App\Models\AdaptiveContent;
use App\Models\User;

class AdaptiveContentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('special_educator');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AdaptiveContent $adaptiveContent): bool
    {
        return $user->hasRole('admin') || $user->hasRole('special_educator');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('special_educator');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AdaptiveContent $adaptiveContent): bool
    {
        return $user->id === $adaptiveContent->created_by_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AdaptiveContent $adaptiveContent): bool
    {
        return $user->id === $adaptiveContent->created_by_id || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AdaptiveContent $adaptiveContent): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AdaptiveContent $adaptiveContent): bool
    {
        return $user->hasRole('admin');
    }
}

