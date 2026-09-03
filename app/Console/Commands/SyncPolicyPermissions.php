<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class SyncPolicyPermissions extends Command
{
    protected $signature = 'permissions:sync
                            {--clean : Remove permissions no longer referenced by policies}';

    protected $description = 'Synchronize Spatie permissions from policy files';

    public function handle(): int
    {
        $policyPath = app_path('Policies');

        if (! File::isDirectory($policyPath)) {
            $this->error("Policies directory not found: {$policyPath}");

            return self::FAILURE;
        }

        $this->info("Scanning: {$policyPath}");
        $this->newLine();

        $permissions = [];

        $policyFiles = File::allFiles($policyPath);

        $this->info("Policy files found: " . count($policyFiles));
        $this->newLine();

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
                | Extract quoted strings
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
        | Remove duplicates
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
                'No permissions were found in the policy files.'
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

            $permission = Permission::firstOrCreate(
                [
                    'name' => $permissionName,
                    'guard_name' => 'web',
                ]
            );

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
        | Clean obsolete permissions
        |--------------------------------------------------------------------------
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
                'Created',
                'Existing',
                'Removed',
                'Skipped',
            ],
            [[
                count($policyFiles),
                count($permissions),
                $created,
                $existing,
                $deleted,
                $skipped,
            ]]
        );

        return self::SUCCESS;
    }
}