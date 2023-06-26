<?php

namespace App\Enums\Project;

enum ProjectStatusEnum: string
{
    case Open = 'open';
    case Active = 'active';
    case Cancelled = 'cancelled';
    case Done = 'done';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
