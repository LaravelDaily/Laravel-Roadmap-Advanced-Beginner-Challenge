<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use function view;

class HomeController extends Controller
{
    public function __invoke()
    {
        $data = [];
        $data['clientsCount'] = Client::query()->count();
        $data['projectsCount'] = Project::query()->count();
        $data['tasksCount'] = Task::query()->count();

        return view('crm.main.index', compact('data'));
    }
}
