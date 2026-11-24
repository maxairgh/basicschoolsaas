<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum UserType: string
{
    use EnumOptions;

     case SYSTEM = 'admin';
    case SCHOOL = 'school';
    case PARENT = 'parent';


    public function label(): string
    {
        return match ($this) {
            self::SYSTEM => 'System Administrator',
            self::SCHOOL => 'School User',
            self::PARENT => 'Parent',
        };
    }
}
