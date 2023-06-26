<?php

namespace App\Enums\Traits;

trait EnumTrait
{
    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
