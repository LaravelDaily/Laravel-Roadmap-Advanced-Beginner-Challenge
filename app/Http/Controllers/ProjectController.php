<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user', 'client', 'user')->paginate();

        return view('projects.index', compact('projects'));
    }
    
    public function create()
    {
        $users = User::EmailVerified()->get();
        $clients = Client::active()->get();
        return view('projects.create', compact(['users', 'clients']))->with('statuses', Project::STATUS);
    }

    public function edit(Project $project)
    {
        $users = User::EmailVerified()->get();
        $clients = Client::active()->get();
        return view('projects.edit', compact(['users', 'clients', 'project']))->with('statuses', Project::STATUS);
    }


    public function update(Project $project, Request $request)
    {
        $project->update($request->all());

        $projects = Project::with('user', 'client')->paginate();

        return redirect(route('projects.index', compact('projects')))->with('status', 'Project updated!');
    }

    public function show(Project $project)
    {

        return view('projects.show', compact('project'));
    }

    public function store(StoreProjectRequest $request)
    {
        
        $project = Project::create($request->all());
        $projects = Project::with('user', 'client')->paginate();
        return view('projects.index', compact('projects'))->with('status', 'Project created!');
    }

    public function destroy(Project $project)
    {
        try {
            $project->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if($e->getCode() === '500') {
               return redirect()->back()->with('status', 'Can not delete this project!');
           }
        }
       
        return redirect(route('projects.index'))->with('status', 'Project deleted!');
    }
}
