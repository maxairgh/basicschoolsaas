<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
             if ($user->hasAllPermissions(['User.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
             if ($user->hasAllPermissions(['User.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
             if ($user->hasAllPermissions(['User.Create'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
             if ($user->hasAllPermissions(['User.Update'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
             if ($user->hasAllPermissions(['User.Delete'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
             if ($user->hasAllPermissions(['User.Restore'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
             if ($user->hasAllPermissions(['User.ForceDelete'])){
            return true;
        };
        return false;
    }
}
