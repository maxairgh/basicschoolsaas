<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum SchoolCategory: string
{
    use EnumOptions;

    case BASIC = 'basic';
    case SECONDARY = 'secondary';
    case TECHNICAL = 'technical';
    case OTHER = 'other';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
