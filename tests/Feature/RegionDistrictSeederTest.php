<?php

use Database\Seeders\RegionDistrictSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('seeds all regions and districts and can be run repeatedly', function () {
    $seeder = app(RegionDistrictSeeder::class);

    $seeder->run();
    $seeder->run();

    expect(DB::table('regions')->count())->toBe(16)
        ->and(DB::table('districts')->count())->toBe(282)
        ->and(DB::table('regions')->where('id', 16)->value('region_name'))->toBe('Western North')
        ->and(DB::table('districts')->where('id', 282)->value('district_name'))->toBe('Suaman')
        ->and(DB::table('districts')->whereNotIn('region_id', range(1, 16))->count())->toBe(0);
});