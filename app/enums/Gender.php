<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum Gender: string
{
    use EnumOptions;

    case MALE = 'male';
    case FEMALE = 'female';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
