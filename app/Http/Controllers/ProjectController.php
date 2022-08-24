<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Clients;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Projects::with('client','user')
        ->porjectsWithStatus($request->get('status') ?? 'all')
        ->paginate(10);
        return view('pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all('id', 'name');
        $clients = Clients::all('id', 'company_name');
        return view('pages.projects.create', compact('users', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        Projects::create($request->validated());
        toast()->success('Successed','Project created successfully');
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Projects $project)
    {
        $project = Projects::with('client','user')->findOrFail($project->id);
        return view('pages.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Projects $project)
    {
        $users = User::all('id', 'name');
        $clients = Clients::all('id', 'company_name');
        return view('pages.projects.edit', compact('project', 'users', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Projects $project)
    {
        $project->update($request->validated());
        toast()->success('Successed','Project updated successfully');
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projects $project)
    {
        try {
            $project->delete();
            toast()->success('Successed','Project deleted successfully');
        } 
        catch (\Illuminate\Database\QueryException $e) {
            toast()->error('Failed','Project can not be deleted, because it is related a Task');
        }
        return back();
    }
}
