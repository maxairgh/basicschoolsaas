<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum SchoolOwnership: string
{
    use EnumOptions;

    case PRIVATE = 'private';
    case PUBLIC = 'public';
    case MISSION = 'mission';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
