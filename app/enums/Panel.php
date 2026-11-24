<?php

namespace App\enums;

use App\Traits\EnumOptions;

enum Panel:string
{
    use EnumOptions;

    case ADMIN = 'admin';
    case SCHOOL = 'school';
    case PARENT = 'parent';

    public function getLabel(): ?string 
    {
        return $this->label();
    }

    public function label(): string
    {
        return match ($this){
            self::ADMIN => 'Admin Panel',
            self::SCHOOL => 'School Panel',
            self::PARENT => 'Parent Panel',
        };
    }
}