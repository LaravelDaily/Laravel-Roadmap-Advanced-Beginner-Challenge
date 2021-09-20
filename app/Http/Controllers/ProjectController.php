<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateProjectRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Services\ProjectService;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::withCount('tasks')
                           ->filterByStatus()
                           ->filterAssignedToUser()
                           ->orderByDesc('id')
                           ->paginate(Project::PAGINATE)
                           ->withQueryString();

        $title = 'Project list';

        return view('project.index', compact('title', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        $title = 'Project create';

        $clients = Client::all('id', 'company');

        $users = User::all('id', 'name');

        return view('project.create', compact('title', 'clients', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUpdateProjectRequest  $request
     * @param  ProjectService  $service
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CreateUpdateProjectRequest $request, ProjectService $service)
    {
        $this->authorize('create', Project::class);

        $project = $service->store($request->validated());

        return redirect(route('project.edit', $project->id))->with('created', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $title = 'Project: '.$project->title;

        $tasks = $project->tasks()
                         ->filterByStatus()
                         ->orderByDesc('id')
                         ->paginate(Task::PAGINATE)
                         ->withQueryString();

        return view('project.show', compact('title', 'project', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $title = 'Project edit: '.$project->title;

        $clients = Client::all('id', 'company');

        $users = User::all('id', 'name');

        return view('project.edit', compact('title', 'project', 'clients', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CreateUpdateProjectRequest  $request
     * @param  Project  $project
     * @param  ProjectService  $service
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CreateUpdateProjectRequest $request, Project $project, ProjectService $service)
    {
        $this->authorize('update', $project);

        $service->update($project, $request->validated());

        return redirect(route('project.edit', $project->id))->with('updated', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect(route('project.index'))->with('deleted', true);
    }

    /**
     * Display a listing of the deleted resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted()
    {
        $projects = Project::onlyTrashed()
                           ->filterByStatus()
                           ->filterAssignedToUser()
                           ->orderByDesc('id')
                           ->paginate(Project::PAGINATE)
                           ->withQueryString();

        $title = 'Deleted projects list';

        return view('project.index', compact('title', 'projects'));
    }

    /**
     * Restore the specified resource to storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);

        $this->authorize('restore', $project);

        $project->restore();

        return redirect(route('project.deleted'))->with('restored', true);
    }

    public function removeMedia(Project $project, $mediaId)
    {
        $this->authorize('manageMedia', $project);

        $project->deleteMedia($mediaId);
    }
}
