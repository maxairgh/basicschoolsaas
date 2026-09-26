<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\AcademicYear;
use App\Models\User;

class AcademicYearPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasAllPermissions(['AcademicYear.View'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AcademicYear $academicYear): bool
    {
         if ($user->hasAllPermissions(['AcademicYear.View'])){
            return true;
        };
        return false;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
         if ($user->hasAllPermissions(['AcademicYear.Create'])){
            return true;
        };
        return false; return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AcademicYear $academicYear): bool
    {
        if ($user->hasAllPermissions(['AcademicYear.Update'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AcademicYear $academicYear): bool
    {
        if ($user->hasAllPermissions(['AcademicYear.Delete'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AcademicYear $academicYear): bool
    {
         if ($user->hasAllPermissions(['AcademicYear.Restore'])){
            return true;
        };
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AcademicYear $academicYear): bool
    {
          if ($user->hasAllPermissions(['AcademicYear.ForceDelete'])){
            return true;
        };
        return false;
    }
}
