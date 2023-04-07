<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('client_access');
        $tasks = Task::active()->whereHas('project', function($query) {
            $query->where('deleted_at', null);
        })->get();

        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::active::get();
        $this->authorize('client_create');
        return view('admin.task.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task)
    {
        $this->authorize('client_edit');
        $validated = $request->validate([
            'project_id' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'required|string',
            'completed' => 'required',
        ]);
        $task->update($validated);
        return redirect()->route('admin.tasks.index')->with('success', 'Task Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $this->authorize('client_show');
        return view('admin.task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Task $task )
    {
        $this->authorize('client_edit');
        return view('admin.task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('client_edit');
        $validated = $request->validate([
            'project_id' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'required|string',
            'completed' => 'required',
        ]);
        $task->update($validated);
        return redirect()->route('admin.tasks.index')->with('success', 'Task Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Task $task )
    {
        $this->authorize('client_delete');
        $task->delete();
        return redirect()->route('admin.tasks.index')->with('success', 'Task Deleted');
    }
}
