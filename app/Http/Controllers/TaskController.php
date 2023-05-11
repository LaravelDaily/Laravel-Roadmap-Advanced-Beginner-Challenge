<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('show all user content')) {
            $tasks = Task::latest('id')->paginate(9);
        } else {
            $tasks = Task::latest('id')->where('user_id', auth()->user()->id)->paginate(9);
        }

        return view('tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        $task_status = Task::TASK_STATUS;

        return view('tasks.create')->with([
            'projects' => $projects,
            'task_status' =>  $task_status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $validate_data = $request->validated();
        $validate_data['user_id'] = auth()->id();
        $task = Task::create($validate_data);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $task->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $projects = Project::all();
        $task_status = Task::TASK_STATUS;

        return view('tasks.edit')->with([
            'task' => $task,
            'projects' => $projects,
            'task_status' =>  $task_status
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $validate_data = $request->validated();
        $validate_data['user_id'] = auth()->id();
        $task->update($validate_data);

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $task->clearMediaCollection('images');
            $task->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete');

        $task->delete();
        return redirect()->route('tasks.index');
    }
}
