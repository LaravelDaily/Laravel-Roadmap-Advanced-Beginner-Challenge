<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Gate::allows('show all user content')) {
            $projects = Project::latest('id')->paginate(9);
        }else {
            $projects = Project::latest('id')->where('user_id', auth()->user()->id)->paginate(9);
        }

        return view('projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $project_status = Project::PROJECT_STATUS;
        
        return view('projects.create')->with([
            'clients' => $clients,
            'project_status' => $project_status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $validate_data = $request->validated(); 
        $validate_data['user_id'] = auth()->id();
        $project = Project::create($validate_data);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $project->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Gate::authorize('delete');

        $project->delete();
        return redirect()->route('projects.index');
    }
}
