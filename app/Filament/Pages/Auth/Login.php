<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;

class Login extends BaseLogin
{
    public function getHeading(): string
    {
        return match (filament()->getCurrentPanel()->getId()) {
            'admin' => 'Admin Sign In',
            'school' => 'School Sign In',
            'parent' => 'Parent Sign In',
            default => 'Sign In',
        };
    }

    public function getSubheading(): ?string
    {
        return match (filament()->getCurrentPanel()->getId()) {
            'admin' => 'Sign in to access the administration panel.',
            'school' => 'Sign in to manage your school account.',
            'parent' => 'Sign in to access your wards details.',
            default => 'Sign in to continue.',
        };
    }
}