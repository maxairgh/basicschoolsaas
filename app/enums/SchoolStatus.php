<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum SchoolStatus: string
{
    use EnumOptions;

    case TRIAL = 'trial';
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case EXPIRED = 'expired';
    case CLOSED = 'closed';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
