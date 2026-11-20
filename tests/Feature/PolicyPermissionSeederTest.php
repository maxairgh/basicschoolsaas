<?php

use Database\Seeders\PolicyPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;

uses(RefreshDatabase::class);

it('seeds unique permissions referenced by policies and can be run repeatedly', function () {
    $seeder = app(PolicyPermissionSeeder::class);

    $seeder->run();
    $seeder->run();

    expect(Permission::where('name', 'Term.View')->where('guard_name', 'web')->count())->toBe(1)
        ->and(Permission::where('name', 'Term.ForceDelete')->where('guard_name', 'web')->exists())->toBeTrue();
});
