<?php

namespace App\Enums\Task;

use App\Enums\Traits\EnumTrait;

enum TaskStatusesEnum: string
{
    use EnumTrait;

    case Add = 'add';
    case InProcess = 'in process';
    case Cancelled = 'cancelled';
    case Finish = 'finish';
}
