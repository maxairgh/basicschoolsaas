<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Term;
use App\Models\User;

class TermPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasAllPermissions(['Term.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Term $term): bool
    {
          if ($user->hasAllPermissions(['Term.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
          if ($user->hasAllPermissions(['Term.Create'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Term $term): bool
    {
          if ($user->hasAllPermissions(['Term.Update'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Term $term): bool
    {
           if ($user->hasAllPermissions(['Term.Delete'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Term $term): bool
    {
           if ($user->hasAllPermissions(['Term.Restore'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Term $term): bool
    {
           if ($user->hasAllPermissions(['Term.ForceDelete'])){
            return true;
        };
        return false;
    }
}
