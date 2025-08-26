<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        
        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->validated());
        
        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
