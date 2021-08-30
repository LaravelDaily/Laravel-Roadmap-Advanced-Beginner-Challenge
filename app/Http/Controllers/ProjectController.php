<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Client;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use DateTime;
use App\Mail\ProjectCreated;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ProjectUpdated;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     */
    public function index( Request $request)
    {
        if(!$request['status']){
            $projects = Project::excludeState(4)->orderBy('deadline', 'asc')->get();
        }elseif($request['status'] === 'all'){
            $projects = Project::orderBy('deadline', 'asc')->get();
        }else{
            $projects = Project::state($request['status'])->orderBy('deadline', 'asc')->get();
        }

        return view('project.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $resources = $this->getResources();

        return view('project.create', [
            'users' => $resources['users'],
            'clients' => $resources['clients'],
            'states' => $resources['states']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectRequest $projectRequest
     */
    public function store(ProjectRequest $projectRequest)
    {
        $project = new Project();
        $validated = $projectRequest->validated();

        $projectCreated = $this->saveInformation($project, $validated);

        Mail::to($projectCreated->user)->send(new ProjectCreated($projectCreated));

        return redirect('projects')->with('message', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function show(Project $project)
    {
        return view('project.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function edit(Project $project)
    {
        $resources = $this->getResources();
        $date = strtr($project->deadline, '/', '-');
        $date2 = DateTime::createFromFormat('m-d-Y', $date);
        $deadline = $date2->format('Y-m-d');

        return view('project.edit', [
            'project' => $project,
            'users' => $resources['users'],
            'deadline' => $deadline,
            'clients' => $resources['clients'],
            'states' => $resources['states']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectRequest $projectRequest
     * @param  \App\Models\Project  $project
     */
    public function update(ProjectRequest $projectRequest, Project $project)
    {
        $validated = $projectRequest->validated();

        $projectUpdated = $this->saveInformation($project, $validated);

        $projectUpdated->user->notify(new ProjectUpdated($projectUpdated));

        return redirect()->route('projects.show', $project)->with('message', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('projects')->with('message', 'Project deleted successfully');
    }

    /**
     * Get users, clients and status
     */
    public function getResources()
    {
        $users = User::all();
        $clients = Client::active()->get();
        $states = Status::all();

        return [
            'users' => $users,
            'clients' => $clients,
            'states' => $states
        ];
    }

    /**
     * Save project info
     *
     * @param Project $project
     * @param array $values
     *
     * @return Project $project
     */
    public function saveInformation(Project $project, array $values)
    {
        $project->title = $values['title'];
        $project->description = $values['description'];
        $project->deadline = $values['deadline'];
        $project->user_id = $values['user_id'];
        $project->client_id = $values['client_id'];

        if (!isset($values['state_id']) || $values['state_id'] === null){
            $project->status_id = 1;
        }else{
            $project->status_id = $values['state_id'];
        }
        $project->save();

        return $project;
    }
}
