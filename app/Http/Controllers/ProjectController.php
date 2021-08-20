<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;;
use Auth;
use App\Http\Requests\ProjectStoreRequest;


class ProjectController extends Controller
{

    public $users=[];
    public $allowedUsers=[]; /* has admin or user rule */
    public $clients=[];
    public function __construct()
    {
        $users=User::with('roles')->orderBy('name')->get();
        $this->allowedUsers=$users->filter(function($user) {
            return $user->hasRole(['admin','user']);
        })->pluck('name','id');
        $this->users=$users->pluck('name','id');
        $this->clients=Client::orderBy('name')->get()->pluck('name','id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::withCount('tasks')
                ->with('tasks')
                ->with('client')
                ->with('assignedTo')
                ->orderBy('tasks_count', 'desc')->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth::user()->hasRole('admin'), 401, __('Not Allowed action'));
        return view('projects.create',['users'=>$this->allowedUsers,'clients'=>$this->clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProjectStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        if (!$project=Project::create($request->validated())) {
            return redirect()->back()->with(['error' => __('Create error')]);
        }
        if ($request->hasFile('logo')) {
          //  $request->logo->storeAs('logo', $request->logo->getClientOriginalName());

            $project->addMediaFromRequest('logo')->toMediaCollection('projects');


        }
        return redirect()->to(url('/projects'))->with(['message' => $project->name . ' ' . __('Successfully created')]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        abort_if(
            (   !Auth::user()->hasRole('admin') &&
                !(Auth::user()->hasRole('user') && (int)Auth::id() === (int)$project->created_by)
            ), 401, __('Not Allowed action'));
        return view('projects.edit', ['users'=>$this->users,'clients'=>$this->clients,'project'=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProjectStoreRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectStoreRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
