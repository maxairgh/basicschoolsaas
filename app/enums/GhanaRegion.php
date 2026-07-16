<?php

namespace App\Enums;

use App\Traits\EnumOptions;

enum GhanaRegion: string
{

    use EnumOptions;
    
    case AHAFO = 'ahafo';

    case ASHANTI = 'ashanti';

    case BONO = 'bono';

    case BONO_EAST = 'bono_east';

    case CENTRAL = 'central';

    case EASTERN = 'eastern';

    case GREATER_ACCRA = 'greater_accra';

    case NORTH_EAST = 'north_east';

    case NORTHERN = 'northern';

    case OTI = 'oti';

    case SAVANNAH = 'savannah';

    case UPPER_EAST = 'upper_east';

    case UPPER_WEST = 'upper_west';

    case VOLTA = 'volta';

    case WESTERN = 'western';

    case WESTERN_NORTH = 'western_north';



    public function label(): string
    {
        return match($this) {

            self::AHAFO => 'Ahafo',

            self::ASHANTI => 'Ashanti',

            self::BONO => 'Bono',

            self::BONO_EAST => 'Bono East',

            self::CENTRAL => 'Central',

            self::EASTERN => 'Eastern',

            self::GREATER_ACCRA => 'Greater Accra',

            self::NORTH_EAST => 'North East',

            self::NORTHERN => 'Northern',

            self::OTI => 'Oti',

            self::SAVANNAH => 'Savannah',

            self::UPPER_EAST => 'Upper East',

            self::UPPER_WEST => 'Upper West',

            self::VOLTA => 'Volta',

            self::WESTERN => 'Western',

            self::WESTERN_NORTH => 'Western North',

        };
    }
}