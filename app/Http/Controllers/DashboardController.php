<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     */
    public function __invoke()
    {
        $clients = Client::active(true)->get();
        $projects = Project::excludeState(4)->get();
        $tasks = Task::excludeState(4)->get();

        return view('dashboard', [
            'clients' => $clients,
            'projects' => $projects,
            'tasks' => $tasks
        ]);
    }
}
