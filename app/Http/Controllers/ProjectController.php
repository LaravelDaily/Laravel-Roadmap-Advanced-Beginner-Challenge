<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $projects = Project::with(['user', 'client'])->paginate(5);
        $projectTrashed = Project::onlyTrashed();
        return view('panel.tasks.index', compact('projects','projectTrashed', 'unreadNotifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $clients = Client::all();
        $users = User::all();
        $projectTrashed = Project::onlyTrashed();
        return view('panel.project.create', compact('clients','projectTrashed', 'users', 'unreadNotifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'deadline' => 'required',
            'user_id' => 'required',
            'client_id' => 'required',
            'status' => 'required'
        ]);

        Project::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
            'user_id' => $request->input('user_id'),
            'client_id' => $request->input('client_id'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('project.index')->with('msg', 'Task Created');
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $projectTrashed = Project::onlyTrashed();
        return view('panel.project.show', compact('project',"projectTrashed", 'unreadNotifications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $projectTrashed = Project::onlyTrashed();
        return view('panel.project.edit', compact('project',  "projectTrashed",'unreadNotifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'min:6',
            'description' => 'min:10'
        ]);

        $project->update($request->all());
        return redirect()->route('tasks.index')->with('msg', 'Task Updated');
    }

    public function restore(Project $project)
    {
        if($project->trashed()){
            $project->restore();
            return redirect()->route('tasks.index')->with('msg', 'Task Restored');
        }
    }

    public function trash()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $trashedProject = Project::onlyTrashed()->paginate(5);
        return view("panel.project.trash", compact('trashedProject', 'unreadNotifications'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if($project->trashed()){
            $project->forceDelete();
        }
        $project->delete();

        return redirect()->route('tasks.index')->with('msg', 'Task Deleted');
    }
}
