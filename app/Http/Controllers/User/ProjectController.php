<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('client_access');
        $projects = Project::active()->whereHas('client', function($query) {
            $query->where('deleted_at', null);
        })->whereHas('user', function($query) {
            $query->where('deleted_at', null);
        })->get();
        return view('user.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('client_create');
        $status = Project::STATUS;
        $users = User::active()->get();
        $clients = Client::active()->get();
        return view('user.projects.create',compact( 'users', 'clients','status') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $this->authorize('client_edit');
        $validated = $request->validate([
            'client_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'status' => 'required',
        ]);
        $project->create($validated);
        return redirect()->route('user.projects.index')->with('success', 'Project Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('client_show');
        return view('user.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('client_edit');
        $status = Project::STATUS;
        $users = User::active()->get();
        $clients = Client::active()->get();
        return view('user.projects.edit', compact('project','users','clients','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('client_edit');

        //dd($request);
        $validated = $request->validate([
            'client_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'status' => 'required'
        ]);
        $project->update($validated);
        return redirect()->route('user.projects.index')->with('success', 'Project Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('client_delete');
        $project->delete();
        return redirect()->route('user.projects.index')->with('success', 'Project Deleted');
    }
}
