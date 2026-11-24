<?php

use App\Enums\Panel;
use App\Enums\Gender;
use App\Enums\LearnerStatus;
use App\Enums\SchoolCategory;
use App\Enums\SchoolApplicationStatus;
use App\Enums\SchoolOwnership;
use App\Enums\SchoolStatus;
use App\Enums\UserType;

it('provides labeled options for enums using the enum options trait', function () {
    expect(Panel::options())
        ->toHaveKey(Panel::ADMIN->value, 'Admin Panel')
        ->and(Panel::ADMIN->getLabel())->toBe('Admin Panel')
        ->and(SchoolApplicationStatus::options())
        ->toHaveKey(SchoolApplicationStatus::PENDING->value, 'Pending Review')
        ->and(UserType::options())
        ->toHaveKey(UserType::SYSTEM->value, 'System Administrator');
});

it('provides options for school and learner enums', function () {
    expect(SchoolOwnership::options())
        ->toBe(['private' => 'Private', 'public' => 'Public', 'mission' => 'Mission'])
        ->and(SchoolCategory::options())
        ->toBe([
            'basic' => 'Basic',
            'secondary' => 'Secondary',
            'technical' => 'Technical',
            'other' => 'Other',
        ])
        ->and(Gender::options())
        ->toBe(['male' => 'Male', 'female' => 'Female'])
        ->and(SchoolStatus::options())
        ->toBe([
            'trial' => 'Trial',
            'active' => 'Active',
            'suspended' => 'Suspended',
            'expired' => 'Expired',
            'closed' => 'Closed',
        ])
        ->and(LearnerStatus::options())
        ->toBe([
            'active' => 'Active',
            'suspended' => 'Suspended',
            'withdrawn' => 'Withdrawn',
            'deceased' => 'Deceased',
            'graduated' => 'Graduated',
        ])
        ->and(array_map(fn (LearnerStatus $status) => $status->icon(), LearnerStatus::cases()))
        ->toBe([
            'heroicon-o-check-circle',
            'heroicon-o-pause-circle',
            'heroicon-o-arrow-right-start-on-rectangle',
            'heroicon-o-minus-circle',
            'heroicon-o-academic-cap',
        ])
        ->and(array_map(fn (LearnerStatus $status) => $status->color(), LearnerStatus::cases()))
        ->toBe(['success', 'warning', 'gray', 'danger', 'primary']);
});
