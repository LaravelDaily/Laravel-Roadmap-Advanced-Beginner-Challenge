<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Crm\Task\StoreRequest;
use App\Http\Requests\Crm\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return TaskResource::collection(Task::query()->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        return new TaskResource(
          Task::query()->create($data)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Task $task)
    {
        $task->update($request->validated());

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }
}
