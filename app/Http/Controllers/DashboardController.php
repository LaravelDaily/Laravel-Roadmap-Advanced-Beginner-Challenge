<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Response;
use App\Models\Task;

class DashboardController extends Controller
{

    public function index()
    {
        $projects = Project::withCount('tasks')
                           ->orderByDesc(
                               Task::select('id')
                                   ->whereColumn('tasks.project_id', 'projects.id')
                                   ->orderByDesc('id')
                                   ->limit(1)
                           )
                           ->limit(5)
                           ->get();

        $tasks = Task::query()
                     ->orderByDesc(
                         Response::select('id')
                                 ->whereColumn('responses.task_id', 'tasks.id')
                                 ->orderByDesc('id')
                                 ->limit(1)
                     )
                     ->limit(5)
                     ->get();

        $responses = Response::with('task')
                             ->orderByDesc('id')
                             ->limit(5)
                             ->get();

        return view('dashboard', compact('projects', 'tasks', 'responses'));
    }
}
