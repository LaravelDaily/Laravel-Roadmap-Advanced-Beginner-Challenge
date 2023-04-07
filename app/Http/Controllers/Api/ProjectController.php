<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::active()->whereHas('client', function($query) {
            $query->where('deleted_at', null);
        })->whereHas('user', function($query) {
            $query->where('deleted_at', null);
        })->get();
        return ProjectResource::collection( $projects  );
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
            "client_id" => 'required|numeric|max:99999',
            "user_id" => 'required|numeric|max:99999',
            "title" => 'required|string|max:255',
            "description" => 'required|string',
            "deadline" => 'required',
            "status" => 'required|boolean',
        ]);
        $project = Project::create( $validated );
        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Project $project )
    {
        return new ProjectResource( $project );
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
        $validated = $request->validate([
            "client_id" => 'required|numeric|max:99999',
            "user_id" => 'required|numeric|max:99999',
            "title" => 'required|string|max:255',
            "description" => 'required|string',
            "deadline" => 'required',
            "status" => 'required|boolean',
        ]);
        $project->update($validated);
        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Project $project )
    {
        $project->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
