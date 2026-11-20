<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class PolicyPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $policyPath = app_path('Policies');

        if (! File::isDirectory($policyPath)) {
            throw new \RuntimeException("Policies directory not found: {$policyPath}");
        }

        $permissions = [];

        foreach (File::allFiles($policyPath) as $file) {
            if (strtolower($file->getExtension()) !== 'php') {
                continue;
            }

            preg_match_all(
                '/hasAllPermissions\s*\(\s*\[(.*?)\]\s*\)/is',
                File::get($file->getPathname()),
                $matches
            );

            foreach ($matches[1] ?? [] as $permissionBlock) {
                preg_match_all(
                    "/['\"]([^'\"]+)['\"]/",
                    $permissionBlock,
                    $permissionMatches
                );

                foreach ($permissionMatches[1] ?? [] as $permission) {
                    $permission = trim($permission);

                    if ($permission !== '') {
                        $permissions[] = $permission;
                    }
                }
            }
        }

        foreach (array_unique($permissions) as $permissionName) {
            Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'web',
            ]);
        }
    }
}
