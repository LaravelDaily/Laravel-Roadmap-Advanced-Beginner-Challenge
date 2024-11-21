<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user', 'client')->paginate();

        return view('projects.index', compact('projects'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect(route('projects.index'))->with('status', 'Project deleted!');
    }
}
