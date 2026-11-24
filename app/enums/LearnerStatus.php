<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum LearnerStatus: string
{
    use EnumOptions;

    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case WITHDRAWN = 'withdrawn';
    case DECEASED = 'deceased';
    case GRADUATED = 'graduated';

    public function label(): string
    {
        return ucfirst($this->value);
    }

    public function icon(): string
    {
        return match ($this) {
            self::ACTIVE => 'heroicon-o-check-circle',
            self::SUSPENDED => 'heroicon-o-pause-circle',
            self::WITHDRAWN => 'heroicon-o-arrow-right-start-on-rectangle',
            self::DECEASED => 'heroicon-o-minus-circle',
            self::GRADUATED => 'heroicon-o-academic-cap',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::SUSPENDED => 'warning',
            self::WITHDRAWN => 'gray',
            self::DECEASED => 'danger',
            self::GRADUATED => 'primary',
        };
    }
}
