<?php

namespace App\Http\Controllers;

use App\Http\Requests\projectStoreRequest;
use App\Http\Requests\taskStoreRequest;
use App\Models\Client;
use App\Models\Department;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Termwind\render;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware(['auth','verified']);
        $this->authorizeResource(Project::class,'project');
    }

    public function index()
    {
        $projects=Project::with('tasks')->paginate(9);
        return view('projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::all();
        $departments=Department::all();
        $clients=Client::all();
      return view('projects.projectCreate',compact('users','departments','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(projectStoreRequest $request)
    {
        $r=Project::firstOrCreate([
            'title'=>$request->validated('title'),
            'description'=>$request->validated('description'),
            'deadline'=>$request->validated('deadline'),
            'user_id'=>$request->validated('assigned_user'),
            'client_id'=>$request->validated('assigned_client'),
            'department_id'=>$request->validated('department'),
            'status'=>'todo',
        ]);
//        $r->deadline=$request->validated('deadline');
//        $r->save();

     return redirect('/projects');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
//        $this->authorize('update',$project);
        $users=User::all();
        $clients=Client::all();
        $departments=Department::all();

     return view('projects.projectEdit',compact('project','users','clients','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(projectStoreRequest $request, Project $project)
    {
//        $this->authorize('update',$project);

        $project->update([
                'title'=>$request->validated('title'),
                'description'=>$request->validated('description'),
                'deadline'=>$request->validated('deadline'),
                'user_id'=>$request->validated('assigned_user'),
                'client_id'=>$request->validated('assigned_client'),
                'department_id'=>$request->validated('department'),
                'status'=>'todo',
                       ]);
        return redirect('/projects');
    }
    public function details($id){
        $this->authorize('view',Project::find($id));
        try {
            $project=Project::findOrFail($id);
        }catch (ModelNotFoundException $e){
            return view('projects.notfound')->with('error','sorry this project not found in our DB');
        }
        $users=User::all();
     return view('projects.Details_project',compact('project','users'));
    }

    public function addtask(taskStoreRequest $request,$id){
        $this->authorize('addtask',Project::find($id));
        DB::beginTransaction();
        try {
            Project::find($id)->tasks()->create([
                'title'=>$request->validated('title'),
                'description'=>$request->validated('description'),
                'deadline'=>$request->validated('deadline'),
                'status'=>'todo',
                'project_id'=>$id,
                'user_id'=>$request->validated('assigned_user'),
            ]);
            DB::commit();
            }catch (\Throwable $exception){ DB::rollBack();
            }
        $users=User::all();
        $project=Project::find($id);
        return view('projects.Details_project',compact('project','users'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
        }catch (QueryException $e){
            return view('errors.queryException')->with(['error'=>$e->getMessage()]);
        }
        return redirect()->back();
    }

    public function done(){
        $projects=Project::Done()->get();
        return view('projects.index',compact('projects'));
    }

}


