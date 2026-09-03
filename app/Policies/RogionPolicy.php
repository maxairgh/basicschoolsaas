<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Region;
use App\Models\User;

class RogionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
          if ($user->hasAllPermissions(['Region.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Region $region): bool
    {
          if ($user->hasAllPermissions(['Region.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
          if ($user->hasAllPermissions(['Region.Create'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Region $region): bool
    {
          if ($user->hasAllPermissions(['Region.Update'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Region $region): bool
    {
          if ($user->hasAllPermissions(['Region.Delete'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Region $region): bool
    {
          if ($user->hasAllPermissions(['Region.Restore'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Region $region): bool
    {
          if ($user->hasAllPermissions(['Region.ForceDelete'])){
            return true;
        };
        return false;
    }
}
