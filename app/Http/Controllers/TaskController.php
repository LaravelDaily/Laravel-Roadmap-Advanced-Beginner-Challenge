<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use App\Models\Project;
use Auth;

class TaskController extends Controller
{

    public $projects;

    public function __construct()
    {
        $this->projects = Project::orderBy('title')->get()->pluck('title', 'id');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with('project')->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!Auth::user()->hasRole(['admin', 'user']), 401, __('Not Allowed action'));
        return view('tasks.create', ['projects' => $this->projects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\TaskStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        if (!$task = Task::create($request->validated())) {
            return redirect()->back()->with(['error' => __('Create error')]);
        }
        return redirect()->to(url('/projects/' . $task->project_id . '/edit'))->with(['message' => $task->title . ' ' . __('Successfully created')]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //  dd($this->projects);
        abort_if(
            (!Auth::user()->hasRole(['admin', 'user'])
            ), 401, __('Not Allowed action'));
        return view('tasks.edit', ['projects' => $this->projects, 'task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\TaskStoreRequest $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskStoreRequest $request, Task $task)
    {
        if (!$task->update($request->validated())) {
            return redirect()->back()->with(['error' => __('Create error')]);
        }
        return redirect()->to(url('/projects/' . $task->project_id . '/edit'))->with(['message' => $task->title . ' ' . __('Successfully created')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        abort_if(
            (!Auth::user()->hasRole(['admin', 'user'])), 401, __('Not Allowed action'));

        if ($task->delete()) {
            return redirect(url('/projects/' . $task->project_id . '/edit'))->with(['message' => __('Successfully deleted')]);
        }
    }
}
