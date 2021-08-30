<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectCollection;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:create projects')->only('store');
        $this->middleware('permission:read projects')->only(['index', 'show']);
        $this->middleware('permission:update projects')->only('update');
        $this->middleware('permission:delete projects')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        if ($request->state === null) {
            return new ProjectCollection(Project::excludeState(4)->get());
        }else{
            return new ProjectCollection(Project::state($request->state)->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectRequest  $projectRequest
     */
    public function store(ProjectRequest $projectRequest)
    {
        $project = new Project();
        $validated = $projectRequest->validated();

        $response = $this->saveUpdateInfo($project, $validated);

        return response()->json(['message' => 'Project created successfully', 'project' => $response], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return new ProjectResource(Project::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectRequest  $projectRequest
     * @param  int  $id
     */
    public function update(ProjectRequest $projectRequest, $id)
    {
        $project = Project::findOrFail($id);
        $validated = $projectRequest->validated();

        $response = $this->saveUpdateInfo($project, $validated);

        return response()->json(['message' => 'Project updated successfully', 'project' => $response], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return response()->json(['message' => 'Project delete successfully'], 200);
    }

    /**
     * Save and update the project's info
     *
     * @param $project
     * @param $validated
     * @return mixed
     */
    public function saveUpdateInfo($project, $validated)
    {
        $project->title = $validated['title'];
        $project->description = $validated['description'];
        $project->deadline = $validated['deadline'];
        $project->user_id = $validated['user_id'];
        $project->client_id = $validated['client_id'];

        if (!isset($validated['state_id']) || $validated['state_id'] == null){
            $project->status_id = 1;
        }else{
            $project->status_id = $validated['state_id'];
        }

        $project->save();

        return new ProjectResource($project);
    }
}
