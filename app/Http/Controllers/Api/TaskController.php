<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create tasks')->only('store');
        $this->middleware('permission:read tasks')->only(['index', 'show']);
        $this->middleware('permission:update tasks')->only('update');
        $this->middleware('permission:delete tasks')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return new TaskCollection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskRequest  $taskRequest
     */
    public function store(TaskRequest $taskRequest)
    {
        $task = new Task();
        $validated = $taskRequest->validated();

        $response = $this->saveUpdateInfo($task, $validated);

        return response()->json(['message' => 'Task created successfully', 'task' => $response], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        return new TaskResource(Task::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaskRequest  $taskRequest
     * @param  int  $id
     */
    public function update(TaskRequest $taskRequest, $id)
    {
        $task = Task::findOrFail($id);
        $validated = $taskRequest->validated();

        $response = $this->saveUpdateInfo($task, $validated);

        return response()->json(['message' => 'Task updated successfully', 'task' => $response], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }

    /**
     * Save and update Task's info
     *
     * @param $task
     * @param $validated
     * @return TaskResource
     */
    public function saveUpdateInfo($task, $validated)
    {
        $task->title = $validated['title'];
        $task->description = $validated['description'];
        $task->deadline = $validated['deadline'];
        $task->user_id = $validated['user_id'];
        $task->project_id = $validated['project_id'];

        if (!isset($validated['state_id']) || $validated['state_id'] == null){
            $task->status_id = 1;
        }else{
            $task->status_id = $validated['state_id'];
        }

        $task->save();

        return new TaskResource($task);
    }
}
