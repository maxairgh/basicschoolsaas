<?php

namespace App\enums;

enum Panel:string
{
    case ADMIN = 'admin';
    case SCHOOL = 'school';
    case PARENT = 'parent';

    public function getLabel(): ?string 
    {
        return match ($this){
            self::ADMIN => 'Admin Panel',
            self::SCHOOL => 'School Panel',
            self::PARENT => 'Parent Panel',
        };
    }
}