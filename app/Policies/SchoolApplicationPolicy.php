<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\SchoolApplication;
use App\Models\User;

class SchoolApplicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
          if ($user->hasAllPermissions(['SchoolApplication.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SchoolApplication $schoolApplication): bool
    {
          if ($user->hasAllPermissions(['SchoolApplication.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
          if ($user->hasAllPermissions(['SchoolApplication.Create'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SchoolApplication $schoolApplication): bool
    {
          if ($user->hasAllPermissions(['SchoolApplication.Update'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SchoolApplication $schoolApplication): bool
    {
          if ($user->hasAllPermissions(['SchoolApplication.Delete'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SchoolApplication $schoolApplication): bool
    {
          if ($user->hasAllPermissions(['SchoolApplication.Restore'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SchoolApplication $schoolApplication): bool
    {
          if ($user->hasAllPermissions(['SchoolApplication.ForceDelete'])){
            return true;
        };
        return false;
    }

      /**
     * Determine whether the user can permanently delete the model.
     */
    public function approval(User $user, SchoolApplication $schoolApplication): bool
    {
          if ($user->hasAllPermissions(['SchoolApplication.Approval'])){
            return true;
        };
        return false;
    }
}
