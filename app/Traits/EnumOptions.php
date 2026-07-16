<?php

namespace App\Traits;

trait EnumOptions
{
    public static function options(): array
    {
        return collect(static::cases())
            ->mapWithKeys(fn($case) => [
                $case->value => $case->label()
            ])
            ->toArray();
    }

        public function badgeColor(): string
    {
        return match($this->value) {

            'approved',
            'active' => 'success',

            'pending' => 'warning',

            'rejected',
            'cancelled' => 'danger',

            default => 'gray',

        };
    }
}