<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Projects;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Tasks::class, 'task');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Tasks::with('project')
        ->tasksWithStatus($request->get('status') ?? 'all')
        ->paginate(10);
        return view('pages.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Projects::all('id', 'title');
        return view('pages.tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $task = Tasks::create($request->validated());
        toast()->success('Successed','Task Created Successfully');
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $task)
    {
        $project = Projects::with('user','client')->findOrFail($task->project_id);
        return view('pages.tasks.show', compact('task','project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $task)
    {
        $projects = Projects::all('id', 'title');
        return view('pages.tasks.edit', compact('task','projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Tasks $task)
    {
        $task->update($request->validated());
        toast()->success('Successed','Task Updated Successfully');
        return redirect()->route('tasks.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $task)
    {
        $task->delete();
        toast()->success('Successed','Task Deleted Successfully');
        return redirect()->route('tasks.index');
    }
}
