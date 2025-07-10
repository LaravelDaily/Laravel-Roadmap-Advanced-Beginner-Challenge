<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ProjectNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Models\Project;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected ProjectService $projectService;
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('user', 'client')->paginate(7);
        return new ProjectCollection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        return $this->projectService->create($request->validated());
    }

    /**
     * Display the specified resource.
     * @throws ProjectNotFoundException
     */
    public function show(int $id)
    {
        return $this->projectService->show($id);
    }

    /**
     * Update the specified resource in storage.
     * @throws ProjectNotFoundException
     */
    public function update(UpdateProjectRequest $request, int $id)
    {
        return $this->projectService->update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     * @throws ProjectNotFoundException
     */
    public function destroy(int $id)
    {
        return $this->projectService->delete($id);
    }
}
