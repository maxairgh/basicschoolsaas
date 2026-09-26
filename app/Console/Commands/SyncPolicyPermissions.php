<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class SyncPolicyPermissions extends Command
{
    protected $signature = 'permissions:sync
                            {--clean : Remove permissions no longer referenced by policies or standalone permissions}';

    protected $description = 'Synchronize Spatie permissions from policy files and standalone permissions';

    public function handle(): int
    {
        /*
        |--------------------------------------------------------------------------
        | Permissions not tied to a policy
        |--------------------------------------------------------------------------
        |
        | These permissions are managed manually and may be used directly
        | in Filament, navigation, actions, middleware, etc.
        |
        */

        $standalonePermissions = [
            'Profile.edit',
        ];

        $policyPath = app_path('Policies');

        if (! File::isDirectory($policyPath)) {
            $this->error("Policies directory not found: {$policyPath}");

            return self::FAILURE;
        }

        $this->info("Scanning: {$policyPath}");
        $this->newLine();

        $permissions = [];

        $policyFiles = File::allFiles($policyPath);

        $this->info('Policy files found: ' . count($policyFiles));
        $this->newLine();

        /*
        |--------------------------------------------------------------------------
        | Scan Policy Files
        |--------------------------------------------------------------------------
        */

        foreach ($policyFiles as $file) {
            if (strtolower($file->getExtension()) !== 'php') {
                continue;
            }

            $contents = File::get($file->getPathname());

            /*
            |--------------------------------------------------------------------------
            | Find every hasAllPermissions() call
            |--------------------------------------------------------------------------
            |
            | Supports:
            |
            | $user->hasAllPermissions(['District.Create'])
            |
            | $user->hasAllPermissions([
            |     'District.Create',
            |     'District.Update',
            | ])
            |
            */

            preg_match_all(
                '/hasAllPermissions\s*\(\s*\[(.*?)\]\s*\)/is',
                $contents,
                $matches
            );

            $filePermissions = [];

            foreach ($matches[1] ?? [] as $permissionBlock) {
                /*
                |--------------------------------------------------------------------------
                | Extract quoted permission names
                |--------------------------------------------------------------------------
                */

                preg_match_all(
                    "/['\"]([^'\"]+)['\"]/",
                    $permissionBlock,
                    $permissionMatches
                );

                foreach ($permissionMatches[1] ?? [] as $permission) {
                    $permission = trim($permission);

                    if ($permission === '') {
                        continue;
                    }

                    $permissions[] = $permission;
                    $filePermissions[] = $permission;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Display what was found in each policy
            |--------------------------------------------------------------------------
            */

            $relativePath = str_replace(
                app_path() . DIRECTORY_SEPARATOR,
                '',
                $file->getPathname()
            );

            if (! empty($filePermissions)) {
                $this->info("✓ {$relativePath}");

                foreach (array_unique($filePermissions) as $permission) {
                    $this->line("    → {$permission}");
                }
            } else {
                $this->warn("○ {$relativePath} - no permissions found");
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Add Standalone Permissions
        |--------------------------------------------------------------------------
        */

        if (! empty($standalonePermissions)) {
            $this->newLine();
            $this->info('Standalone permissions:');

            foreach ($standalonePermissions as $permission) {
                $permission = trim($permission);

                if ($permission === '') {
                    continue;
                }

                $permissions[] = $permission;

                $this->line("    → {$permission}");
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Remove Duplicates
        |--------------------------------------------------------------------------
        */

        $permissions = array_values(
            array_unique($permissions)
        );

        sort($permissions);

        $this->newLine();

        /*
        |--------------------------------------------------------------------------
        | Results
        |--------------------------------------------------------------------------
        */

        $this->info(
            'Total unique permissions discovered: ' . count($permissions)
        );

        $this->newLine();

        if (empty($permissions)) {
            $this->warn(
                'No permissions were found in the policy files or standalone permissions.'
            );

            return self::SUCCESS;
        }

        /*
        |--------------------------------------------------------------------------
        | Synchronize with Spatie
        |--------------------------------------------------------------------------
        */

        $created = 0;
        $existing = 0;

        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web',
            ]);

            if ($permission->wasRecentlyCreated) {
                $created++;

                $this->info(
                    "Created: {$permissionName}"
                );
            } else {
                $existing++;

                $this->line(
                    "Existing: {$permissionName}"
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Clean Obsolete Permissions
        |--------------------------------------------------------------------------
        |
        | A permission will only be considered obsolete if it is NOT:
        |
        | 1. Referenced by a policy
        | 2. Listed as a standalone permission
        |
        */

        $deleted = 0;
        $skipped = 0;

        if ($this->option('clean')) {
            $this->newLine();

            $this->info(
                'Checking for obsolete permissions...'
            );

            $databasePermissions = Permission::where(
                'guard_name',
                'web'
            )->get();

            foreach ($databasePermissions as $databasePermission) {
                /*
                |--------------------------------------------------------------------------
                | Permission is still required
                |--------------------------------------------------------------------------
                */

                if (in_array(
                    $databasePermission->name,
                    $permissions,
                    true
                )) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Don't delete permissions assigned to roles
                |--------------------------------------------------------------------------
                */

                if ($databasePermission->roles()->exists()) {
                    $skipped++;

                    $this->warn(
                        "Skipped: {$databasePermission->name} " .
                        "(assigned to a role)"
                    );

                    continue;
                }

                $name = $databasePermission->name;

                $databasePermission->delete();

                $deleted++;

                $this->warn(
                    "Removed: {$name}"
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $this->newLine();

        $this->info(
            'Permission synchronization completed.'
        );

        $this->newLine();

        $this->table(
            [
                'Policy Files',
                'Found',
                'Standalone',
                'Created',
                'Existing',
                'Removed',
                'Skipped',
            ],
            [[
                count($policyFiles),
                count($permissions),
                count($standalonePermissions),
                $created,
                $existing,
                $deleted,
                $skipped,
            ]]
        );

        return self::SUCCESS;
    }
}

