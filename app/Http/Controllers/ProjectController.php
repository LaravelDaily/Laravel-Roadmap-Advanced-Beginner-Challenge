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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('user')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        $clients = Client::all();
        return view('projects.create', compact('clients', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'deadline' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'clients' => 'required',
            'status' => 'required|boolean'
        ]);
        $project = Project::create($validated);
        $project->clients()->attach($validated['clients']);
        return back()->with('status', 'project created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        $clients = Client::all();
        return view('projects.edit', compact('project','users','clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'deadline' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'clients' => 'required',
            'status' => 'required|boolean'
        ]);
        $project->update($request->all());
        $project->clients()->sync($request->clients);
        return back()->with('status', 'project updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->clients()->detach();
        $project->delete();
        return back()->with('status', 'project deleted successfully');
    }
}
