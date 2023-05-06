<?php

namespace App\Http\Controllers;

use App\Http\Requests\taskStoreRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function __construct(){
//        $this->authorizeResource('Task','task');
//    }

    public function index()
    {
       $tasks=Task::all();
       return view('tasks.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        $projects=Project::all();
        $users=User::all();
        $task=Task::find($id);
        return view('tasks.editTask',compact('task','projects','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(taskStoreRequest $request, $id)
    {
        Task::find($id)->update([
            'title'=>$request->validated('title'),
            'description'=>$request->validated('description'),
            'deadline'=>$request->validated('deadline'),
            'status'=>$request->validated('status'),
            'user_id'=>$request->validated('assigned_user'),
            'project_id'=>$request->validated('project'),
        ]);
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete',Task::find($id));
        Task::find($id)->delete();
        return redirect()->back();

    }

}
