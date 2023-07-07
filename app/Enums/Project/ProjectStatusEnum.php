<?php

namespace App\Enums\Project;

use App\Enums\Traits\EnumTrait;

enum ProjectStatusEnum: string
{
    use EnumTrait;

    case Open = 'open';
    case Active = 'active';
    case Cancelled = 'cancelled';
    case Done = 'done';
}
