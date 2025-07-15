<?php

namespace App\Observers;

use App\Models\Project;
use Auth;

class ProjectObserver
{
    public function saving(Project $project)
    {
        switch (request()->method()) {
            case 'POST':
                $project['created_by'] = $project['created_by'] ?? Auth::id();
                break;
            case 'PUT':
                $project['updated_by'] = $project['updated_by'] ?? Auth::id();
                break;
            case 'DELETE':
                $project['deleted_by'] = $project['deleted_by'] ?? Auth::id();
                break;
        }

    }
}
