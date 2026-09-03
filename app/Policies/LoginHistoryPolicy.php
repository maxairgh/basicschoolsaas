<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\LoginHistory;
use App\Models\User;

class LoginHistoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
           if ($user->hasAllPermissions(['LoginHistory.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LoginHistory $loginHistory): bool
    {
           if ($user->hasAllPermissions(['LoginHistory.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
           if ($user->hasAllPermissions(['LoginHistory.Create'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LoginHistory $loginHistory): bool
    {
           if ($user->hasAllPermissions(['LoginHistory.Update'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LoginHistory $loginHistory): bool
    {
           if ($user->hasAllPermissions(['LoginHistory.Delete'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LoginHistory $loginHistory): bool
    {
           if ($user->hasAllPermissions(['LoginHistory.Update'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LoginHistory $loginHistory): bool
    {
           if ($user->hasAllPermissions(['LoginHistory.ForceDelete'])){
            return true;
        };
        return false;
    }
}
