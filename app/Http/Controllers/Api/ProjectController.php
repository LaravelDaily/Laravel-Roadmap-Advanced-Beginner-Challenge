<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('user', 'client')->get();
        return ProjectResource::collection($projects);
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

        return response([
            'message' => 'Project Created',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $project = Project::with('user', 'client')->findOrFail($id);
        } catch (\Exception $e) {
            abort(404, 'Project Not Found');
        }
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'min:6',
            'description' => 'min:10'
        ]);

        $project = Project::findorFail($id);
        $project->update($request->all());

        return response([
            'message' => 'Project Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $project = Project::findorFail($id);
        } catch (\Exception $e) {
            abort(404, 'Project Not Found');
        }
        $project->delete();

        return response([
            'message' => "Project Deleted"
        ]);
    }
}
