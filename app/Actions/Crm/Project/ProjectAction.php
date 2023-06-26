<?php

namespace App\Actions\Crm\Project;

use App\Enums\Project\ProjectStatusEnum;

class ProjectAction
{
    public function getStatusValues(): array
    {
        return ProjectStatusEnum::values();
    }
}
