<?php

namespace App\Enums;

enum SchoolApplicationStatus: string
{
    case PENDING = 'pending';

    case APPROVED = 'approved';

    case REJECTED = 'rejected';

    case CONVERTED = 'converted';


    public function label(): string
    {
        return match($this) {

            self::PENDING => 'Pending Review',

            self::APPROVED => 'Approved',

            self::REJECTED => 'Rejected',

            self::CONVERTED => 'Converted',

        };
    }


    public function color(): string
    {
        return match($this) {

            self::PENDING => 'warning',

            self::APPROVED => 'success',

            self::REJECTED => 'danger',

            self::CONVERTED => 'primary',

        };
    }
}